<?php
// app/Http/Controllers/Admin/DokumenController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\UnitKerja;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    protected $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    /**
     * Display statistics and list of documents
     */
    public function index(Request $request)
    {
        $query = Dokumen::with(['uploader', 'unitKerja', 'iku', 'approver']);

        // Filters
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('unit_kerja_id') && $request->unit_kerja_id !== 'all') {
            $query->where('unit_kerja_id', $request->unit_kerja_id);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $dokumens = $query->orderBy('created_at', 'desc')
                         ->paginate(20)
                         ->withQueryString();

        // Get statistics
        $statistics = $this->documentService->getStatistics() ?? [
            'total' => Dokumen::count(),
            'pending' => Dokumen::where('status', 'pending')->count(),
            'approved' => Dokumen::where('status', 'approved')->count(),
            'rejected' => Dokumen::where('status', 'rejected')->count(),
        ];
        
        // Get statistics per SPMI type
        $perType = [
            'penetapan' => Dokumen::where('category', 'penetapan')->count(),
            'pelaksanaan' => Dokumen::where('category', 'pelaksanaan')->count(),
            'evaluasi' => Dokumen::where('category', 'evaluasi')->count(),
            'pengendalian' => Dokumen::where('category', 'pengendalian')->count(),
            'peningkatan' => Dokumen::where('category', 'peningkatan')->count(),
            'akreditasi' => Dokumen::where('category', 'akreditasi')->count(),
        ];
        
        // Get statistics per unit kerja
        $perUnitKerja = Dokumen::select('unit_kerja_id', DB::raw('count(*) as total'))
            ->with('unitKerja')
            ->whereNotNull('unit_kerja_id')
            ->groupBy('unit_kerja_id')
            ->get()
            ->mapWithKeys(function ($item) {
                $nama = $item->unitKerja->nama_unit ?? 'Tanpa Unit';
                return [$nama => $item->total];
            });
        
        // Get recent activity
        $recentActivities = Dokumen::with('uploader')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $categories = [
            'all' => 'Semua Kategori',
            'penetapan' => 'Penetapan SPMI',
            'pelaksanaan' => 'Pelaksanaan SPMI',
            'evaluasi' => 'Evaluasi SPMI',
            'pengendalian' => 'Pengendalian SPMI',
            'peningkatan' => 'Peningkatan SPMI',
            'akreditasi' => 'Akreditasi',
        ];

        $statuses = [
            'all' => 'Semua Status',
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ];

        $unitKerjas = UnitKerja::where('status', true)->get();
        $status = $request->get('status', 'all');
        $category = $request->get('category', 'all');

        return view('admin.dokumen.index', compact(
            'dokumens', 
            'statistics', 
            'status',
            'category',
            'categories',
            'perType',
            'perUnitKerja',
            'recentActivities',
            'unitKerjas',
            'statuses'
        ));
    }

    /**
     * Show document details
     */
    public function show($id)
    {
        $dokumen = Dokumen::with(['uploader', 'unitKerja', 'approver', 'iku'])
            ->withTrashed()
            ->findOrFail($id);

        return view('admin.dokumen.show', compact('dokumen'));
    }

    /**
     * Approve form (untuk dokumen tertentu)
     */
    public function approveForm($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        if (!$dokumen->isPending()) {
            return redirect()->route('admin.dokumen.index')
                ->with('error', 'Dokumen ini sudah diproses.');
        }

        return view('admin.dokumen.approve', compact('dokumen'));
    }

    /**
     * Update document status (single)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'catatan' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $dokumen = Dokumen::findOrFail($id);

            if ($request->status === 'approved') {
                $dokumen->approve(auth()->id(), $request->catatan);
                $message = 'Dokumen berhasil disetujui.';
            } elseif ($request->status === 'rejected') {
                $dokumen->reject(auth()->id(), $request->catatan ?? 'Dokumen ditolak');
                $message = 'Dokumen ditolak.';
            } else {
                $dokumen->status = $request->status;
                if ($request->has('catatan')) {
                    $dokumen->admin_note = $request->catatan;
                }
                $dokumen->save();
                $message = 'Status dokumen berhasil diperbarui.';
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Approve a single document (alternative method)
     */
    public function approve($id, Request $request)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $dokumen = Dokumen::findOrFail($id);
            $dokumen->approve(auth()->id(), $request->catatan);

            DB::commit();

            return redirect()->back()->with('success', 'Dokumen berhasil disetujui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Reject a single document (alternative method)
     */
    public function reject($id, Request $request)
    {
        $request->validate([
            'catatan' => 'required|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $dokumen = Dokumen::findOrFail($id);
            $dokumen->reject(auth()->id(), $request->catatan);

            DB::commit();

            return redirect()->back()->with('success', 'Dokumen berhasil ditolak.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Bulk update document status
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:dokumens,id',
            'action' => 'required|in:approve,reject',
            'note' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $dokumens = Dokumen::whereIn('id', $request->ids)
                ->where('status', 'pending')
                ->get();

            if ($dokumens->isEmpty()) {
                return back()->with('error', 'Tidak ada dokumen pending yang dipilih.');
            }

            foreach ($dokumens as $dokumen) {
                if ($request->action === 'approve') {
                    $dokumen->approve(auth()->id(), $request->note);
                } else {
                    $dokumen->reject(auth()->id(), $request->note);
                }
            }

            DB::commit();

            $count = $dokumens->count();
            $message = $count . ' dokumen berhasil ' . 
                      ($request->action === 'approve' ? 'disetujui' : 'ditolak');

            return redirect()->route('admin.dokumen.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Soft delete a document
     */
    public function softDelete($id)
    {
        try {
            $dokumen = Dokumen::findOrFail($id);
            $dokumen->delete();

            return redirect()->route('admin.dokumen.index')
                ->with('success', 'Dokumen dipindahkan ke trash.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Display trashed documents
     */
    public function trash(Request $request)
    {
        $query = Dokumen::onlyTrashed()->with(['uploader', 'unitKerja']);

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $dokumens = $query->orderBy('deleted_at', 'desc')->paginate(20);

        $categories = [
            'all' => 'Semua Kategori',
            'penetapan' => 'Penetapan SPMI',
            'pelaksanaan' => 'Pelaksanaan SPMI',
            'evaluasi' => 'Evaluasi SPMI',
            'pengendalian' => 'Pengendalian SPMI',
            'peningkatan' => 'Peningkatan SPMI',
            'akreditasi' => 'Akreditasi',
        ];

        return view('admin.dokumen.trash', compact('dokumens', 'categories'));
    }

    /**
     * Restore a soft deleted document
     */
    public function restore($id)
    {
        try {
            $dokumen = Dokumen::withTrashed()->findOrFail($id);
            $dokumen->restore();

            return redirect()->route('admin.dokumen.index')
                ->with('success', 'Dokumen berhasil dipulihkan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Permanently delete a document
     */
    public function destroy($id)
    {
        try {
            $dokumen = Dokumen::withTrashed()->findOrFail($id);

            // Delete file if exists
            if ($dokumen->jenis_upload !== 'link' && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            // Permanent delete
            $dokumen->forceDelete();

            return redirect()->route('admin.dokumen.trash')
                ->with('success', 'Dokumen dihapus permanen.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Download document
     */
    public function download($id)
    {
        try {
            $dokumen = Dokumen::withTrashed()->find($id);
            
            if (!$dokumen) {
                \Log::warning('Dokumen ID ' . $id . ' not found even with trashed');
                return redirect()->back()->with('error', 'Dokumen tidak ditemukan atau telah dihapus permanen.');
            }
            
            if ($dokumen->jenis_upload === 'link') {
                return redirect()->away($dokumen->file_path);
            }
            
            if (!Storage::disk('public')->exists($dokumen->file_path)) {
                \Log::warning('File not found for dokumen ID ' . $id . ': ' . $dokumen->file_path);
                return redirect()->back()->with('error', 'File dokumen tidak ditemukan.');
            }
            
            \Log::info('Admin downloading dokumen ID: ' . $id);
            return Storage::disk('public')->download($dokumen->file_path, $dokumen->file_name);
        } catch (\Exception $e) {
            \Log::error('Admin download error ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mendownload dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Preview document (for PDF files)
     */
    public function preview($id)
    {
        try {
            $dokumen = Dokumen::withTrashed()->find($id);
            
            if (!$dokumen) {
                return redirect()->back()->with('error', 'Dokumen tidak ditemukan atau telah dihapus permanen.');
            }
            
            if ($dokumen->jenis_upload === 'link') {
                return redirect()->away($dokumen->file_path);
            }
            
            if (!Storage::disk('public')->exists($dokumen->file_path)) {
                \Log::warning('File not found for preview dokumen ID ' . $id);
                return redirect()->back()->with('error', 'File tidak ditemukan untuk preview.');
            }
            
            if ($dokumen->file_extension !== 'pdf') {
                return redirect()->back()->with('error', 'Preview hanya tersedia untuk file PDF.');
            }
            
            \Log::info('Admin previewing dokumen ID: ' . $id);
            return response()->file(Storage::disk('public')->path($dokumen->file_path));
        } catch (\Exception $e) {
            \Log::error('Admin preview error ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mempreview dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Export documents data
     */
    public function export(Request $request)
    {
        $query = Dokumen::with(['uploader', 'unitKerja']);

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('unit_kerja_id') && $request->unit_kerja_id !== 'all') {
            $query->where('unit_kerja_id', $request->unit_kerja_id);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $dokumens = $query->orderBy('created_at', 'desc')->get();

        $filename = 'dokumen_' . date('Y-m-d_H-i-s') . '.csv';
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Add CSV headers
        fputcsv($handle, [
            'No', 
            'Nama Dokumen', 
            'Kategori', 
            'Pengupload', 
            'Unit Kerja', 
            'Status', 
            'Tanggal Upload', 
            'Catatan Admin'
        ]);

        foreach ($dokumens as $index => $dokumen) {
            fputcsv($handle, [
                $index + 1,
                $dokumen->nama_dokumen,
                $dokumen->category_label ?? ucfirst($dokumen->category ?? '-'),
                $dokumen->uploader->name ?? '-',
                $dokumen->unitKerja->nama ?? '-',
                ucfirst($dokumen->status),
                $dokumen->created_at->format('d/m/Y H:i'),
                $dokumen->admin_note ?? '-',
            ]);
        }

        fclose($handle);
        exit;
    }
}