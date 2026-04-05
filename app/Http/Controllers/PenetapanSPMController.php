<?php

namespace App\Http\Controllers;

use App\Models\PenetapanSPM;
use App\Models\Dokumen;
use App\Models\UnitKerja;
use App\Models\Iku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PenetapanSPMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dengan filter
        $query = PenetapanSPM::with(['dokumen', 'unitKerja', 'iku']);
        
        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_komponen', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%')
                  ->orWhere('kode_penetapan', 'like', '%' . $search . '%');
            });
        }
        
        // Filter tipe
        if ($request->has('tipe') && $request->tipe != '' && $request->tipe != 'all') {
            $query->where('tipe_penetapan', $request->tipe);
        }
        
        // Filter status
        if ($request->has('status') && $request->status != '' && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter status dokumen
        if ($request->has('status_dokumen') && $request->status_dokumen != '' && $request->status_dokumen != 'all') {
            $query->where('status_dokumen', $request->status_dokumen);
        }
        
        // Filter tahun
        if ($request->has('tahun') && $request->tahun != '' && $request->tahun != 'all') {
            $query->where('tahun', $request->tahun);
        }
        
        // Filter unit kerja
        if ($request->has('unit_kerja_id') && $request->unit_kerja_id != '' && $request->unit_kerja_id != 'all') {
            $query->where('unit_kerja_id', $request->unit_kerja_id);
        }
        
        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
        
        $penetapan = $query->paginate(20);
        
        // Data untuk filter dropdown
        $tahunList = PenetapanSPM::select('tahun')->distinct()->orderBy('tahun', 'desc')->get();
        $unitKerjaList = UnitKerja::where('status', true)->get();
        
        // Statistics
        $totalPenetapan = PenetapanSPM::count();
        $penetapanAktif = PenetapanSPM::where('status', 'aktif')->count();
        $dokumenValid = PenetapanSPM::where('status_dokumen', 'valid')->count();
        $dokumenBelumValid = PenetapanSPM::where('status_dokumen', 'belum_valid')->count();
        
        return view('dashboard.spmi.penetapan.index', compact(
            'penetapan', 
            'tahunList', 
            'unitKerjaList',
            'totalPenetapan',
            'penetapanAktif',
            'dokumenValid',
            'dokumenBelumValid'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unitKerjas = UnitKerja::where('status', true)->get();
        $ikus = Iku::where('status', true)->get();
        
        return view('dashboard.spmi.penetapan.create', compact('unitKerjas', 'ikus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi
            $request->validate([
                'nama_komponen' => 'required|string|max:255',
                'tipe_penetapan' => 'required|in:pengelolaan,organisasi,pelaksanaan,evaluasi,pengendalian,peningkatan',
                'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 5),
                'status' => 'required|in:aktif,nonaktif,revisi',
                'status_dokumen' => 'in:valid,belum_valid,dalam_review',
                'deskripsi' => 'nullable|string',
                'penanggung_jawab' => 'nullable|string|max:255',
                'unit_kerja_id' => 'nullable|exists:unit_kerjas,id',
                'iku_id' => 'nullable|exists:ikus,id',
            ]);
            
            // Generate kode otomatis
            $tipe = $request->tipe_penetapan;
            $tahun = $request->tahun;
            $count = PenetapanSPM::where('tipe_penetapan', $tipe)
                ->where('tahun', $tahun)
                ->count() + 1;
            
            $kode = strtoupper(substr($tipe, 0, 3)) . '-' . $tahun . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
            
            // Create penetapan
            $penetapan = PenetapanSPM::create([
                'nama_komponen' => $request->nama_komponen,
                'tipe_penetapan' => $tipe,
                'tahun' => $tahun,
                'status' => $request->status,
                'status_dokumen' => $request->status_dokumen ?? 'belum_valid',
                'deskripsi' => $request->deskripsi,
                'penanggung_jawab' => $request->penanggung_jawab,
                'kode_penetapan' => $kode,
                'unit_kerja_id' => $request->unit_kerja_id,
                'iku_id' => $request->iku_id,
            ]);
            
            // Jika request AJAX, return JSON
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data penetapan berhasil ditambahkan.',
                    'data' => $penetapan
                ]);
            }
            
            return redirect()->route('penetapan.index')
                ->with('success', 'Data penetapan berhasil ditambahkan.');
                
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan data: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                         ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $penetapan = PenetapanSPM::with(['dokumen', 'unitKerja', 'iku'])->findOrFail($id);
            
            // Get all documents related to this penetapan
            $allDokumen = Dokumen::where('penetapan_spmi_id', $id)
                ->orWhere('metadata', 'like', '%"penetapan_id":' . $id . '%')
                ->orderBy('created_at', 'desc')
                ->get();
            
            return view('dashboard.spmi.penetapan.show', compact('penetapan', 'allDokumen'));
            
        } catch (\Exception $e) {
            return redirect()->route('penetapan.index')
                ->with('error', 'Data tidak ditemukan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $penetapan = PenetapanSPM::findOrFail($id);
            $unitKerjas = UnitKerja::where('status', true)->get();
            $ikus = Iku::where('status', true)->get();
            
            return view('dashboard.spmi.penetapan.edit', compact('penetapan', 'unitKerjas', 'ikus'));
            
        } catch (\Exception $e) {
            return redirect()->route('penetapan.index')
                ->with('error', 'Data tidak ditemukan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $penetapan = PenetapanSPM::findOrFail($id);
            
            // Validasi
            $request->validate([
                'nama_komponen' => 'required|string|max:255',
                'tipe_penetapan' => 'required|in:pengelolaan,organisasi,pelaksanaan,evaluasi,pengendalian,peningkatan',
                'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 5),
                'status' => 'required|in:aktif,nonaktif,revisi',
                'status_dokumen' => 'in:valid,belum_valid,dalam_review',
                'deskripsi' => 'nullable|string',
                'penanggung_jawab' => 'nullable|string|max:255',
                'unit_kerja_id' => 'nullable|exists:unit_kerjas,id',
                'iku_id' => 'nullable|exists:ikus,id',
            ]);
            
            // Update data
            $penetapan->update([
                'nama_komponen' => $request->nama_komponen,
                'tipe_penetapan' => $request->tipe_penetapan,
                'tahun' => $request->tahun,
                'status' => $request->status,
                'status_dokumen' => $request->status_dokumen ?? $penetapan->status_dokumen,
                'deskripsi' => $request->deskripsi,
                'penanggung_jawab' => $request->penanggung_jawab,
                'unit_kerja_id' => $request->unit_kerja_id,
                'iku_id' => $request->iku_id,
                'tanggal_review' => now(),
            ]);
            
            // Jika request AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data penetapan berhasil diperbarui.',
                    'data' => $penetapan
                ]);
            }
            
            return redirect()->route('penetapan.index')
                ->with('success', 'Data penetapan berhasil diperbarui.');
                
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui data: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())
                         ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $penetapan = PenetapanSPM::findOrFail($id);
            
            // Soft delete penetapan
            $penetapan->delete();
            
            return redirect()->route('penetapan.index')
                ->with('success', 'Data penetapan berhasil dihapus.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * AJAX: Get detail for modal
     */
    public function ajaxDetail($id)
    {
        try {
            $penetapan = PenetapanSPM::with(['unitKerja', 'iku'])->findOrFail($id);
            
            // Get dokumen terkait
            $allDokumen = Dokumen::where('penetapan_spmi_id', $id)
                ->orWhere('metadata', 'like', '%"penetapan_id":' . $id . '%')
                ->orWhere('metadata', 'like', '%' . $penetapan->kode_penetapan . '%')
                ->orderBy('created_at', 'desc')
                ->get();
            
            $html = view('spmi.penetapan.detail-modal', compact('penetapan', 'allDokumen'))->render();
            
            return response()->json([
                'success' => true,
                'html' => $html
            ]);
            
        } catch (\Exception $e) {
            Log::error('AJAX Detail Penetapan Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat detail. ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * AJAX: Get edit form for modal
     */
    public function ajaxEditForm($id)
    {
        try {
            $penetapan = PenetapanSPM::findOrFail($id);
            $unitKerjas = UnitKerja::where('status', true)->get();
            $ikus = Iku::where('status', true)->get();
            
            $html = view('spmi.penetapan.edit-form', compact('penetapan', 'unitKerjas', 'ikus'))->render();
            
            return response()->json([
                'success' => true,
                'html' => $html
            ]);
            
        } catch (\Exception $e) {
            Log::error('AJAX Edit Form Penetapan Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat form edit. ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload dokumen untuk penetapan.
     */
    public function uploadDokumen(Request $request, $id)
    {
        try {
            $penetapan = PenetapanSPM::findOrFail($id);
            
            // Validasi file
            $request->validate([
                'file_dokumen' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png',
                'keterangan' => 'nullable|string|max:500',
                'jenis_dokumen' => 'nullable|string|max:100',
                'nama_dokumen' => 'nullable|string|max:255',
            ]);
            
            // Upload file
            if ($request->hasFile('file_dokumen') && $request->file('file_dokumen')->isValid()) {
                $file = $request->file('file_dokumen');
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                // Generate folder path based on tahun and tipe_penetapan
                $folderPath = 'dokumen/spmi/penetapan/' . $penetapan->tipe_penetapan . '/' . $penetapan->tahun;
                
                // Generate unique filename
                $fileName = Str::slug($penetapan->nama_komponen) . '_' . time() . '_' . Str::random(5) . '.' . $extension;
                
                // Store file
                $filePath = $file->storeAs($folderPath, $fileName, 'public');
                
                // Unit kerja default (LPM) jika tidak ada
                $unitKerjaId = $penetapan->unit_kerja_id ?? 1;
                $ikuId = $penetapan->iku_id ?? 1;
                
                // Generate nama dokumen
                $namaDokumen = $request->nama_dokumen ?? ($penetapan->nama_komponen . ' - ' . ($request->jenis_dokumen ?? 'Dokumen Penetapan'));
                
                // Create dokumen record
                $dokumen = Dokumen::create([
                    'unit_kerja_id' => $unitKerjaId,
                    'iku_id' => $ikuId,
                    'penetapan_spmi_id' => $penetapan->id,
                    'jenis_dokumen' => $request->jenis_dokumen ?? 'Penetapan SPMI',
                    'nama_dokumen' => $namaDokumen,
                    'keterangan' => $request->keterangan ?? 'Dokumen penetapan SPMI',
                    'file_path' => $filePath,
                    'file_name' => $originalName,
                    'file_size' => $file->getSize(),
                    'file_extension' => $extension,
                    'jenis_upload' => 'file',
                    'uploaded_by' => auth()->id(),
                    'is_public' => true,
                    'tahapan' => 'penetapan',
                    'metadata' => json_encode([
                        'penetapan_id' => $penetapan->id,
                        'nama_komponen' => $penetapan->nama_komponen,
                        'tipe_penetapan' => $penetapan->tipe_penetapan,
                        'tahun' => $penetapan->tahun,
                        'penanggung_jawab' => $penetapan->penanggung_jawab,
                        'kode_penetapan' => $penetapan->kode_penetapan,
                        'upload_source' => $request->input('upload_source', 'inline_form')
                    ])
                ]);
                
                // Update dokumen count
                $dokumenCount = Dokumen::where('penetapan_spmi_id', $penetapan->id)->count();
                
                $penetapan->update([
                    'status_dokumen' => 'valid',
                    'tanggal_penetapan' => now(),
                    'dokumen_count' => $dokumenCount
                ]);
                
                // Jika request AJAX
                if ($request->ajax() || $request->input('upload_source') === 'inline_modal') {
                    return response()->json([
                        'success' => true,
                        'message' => 'Dokumen berhasil diupload.',
                        'dokumen' => $dokumen,
                        'penetapan' => $penetapan,
                        'dokumen_count' => $dokumenCount
                    ]);
                }
                
                return redirect()->route('penetapan.show', $penetapan->id)
                    ->with('success', 'Dokumen berhasil diupload dan terkait dengan penetapan.');
            }
            
            return back()->with('error', 'File tidak valid.');
            
        } catch (\Exception $e) {
            Log::error('Upload Dokumen Penetapan Error: ' . $e->getMessage());
            
            if ($request->ajax() || $request->input('upload_source') === 'inline_modal') {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengupload dokumen: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Gagal mengupload dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Get dokumen list for penetapan
     */
    public function getDokumenList($id)
    {
        try {
            $penetapan = PenetapanSPM::findOrFail($id);
            $allDokumen = Dokumen::where('penetapan_spmi_id', $id)
                ->orWhere('metadata', 'like', '%"penetapan_id":' . $id . '%')
                ->orderBy('created_at', 'desc')
                ->get();
            
            $html = view('spmi.penetapan.partials.dokumen-list', compact('allDokumen'))->render();
            
            return response()->json([
                'success' => true,
                'html' => $html,
                'count' => $allDokumen->count()
            ]);
            
        } catch (\Exception $e) {
            Log::error('Get Dokumen List Penetapan Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data dokumen: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update status dokumen.
     */
    public function updateStatusDokumen(Request $request, $id)
    {
        try {
            $penetapan = PenetapanSPM::findOrFail($id);
            
            $request->validate([
                'status_dokumen' => 'required|in:valid,belum_valid,dalam_review',
                'catatan' => 'nullable|string|max:500',
            ]);
            
            $penetapan->update([
                'status_dokumen' => $request->status_dokumen,
                'catatan_verifikasi' => $request->catatan,
                'tanggal_review' => now(),
                'diperiksa_oleh' => auth()->user()->name ?? 'System',
            ]);
            
            // Jika request AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status dokumen berhasil diperbarui.',
                    'status_dokumen' => $penetapan->status_dokumen
                ]);
            }
            
            return redirect()->route('penetapan.show', $penetapan->id)
                ->with('success', 'Status dokumen berhasil diperbarui.');
                
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui status: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }
}