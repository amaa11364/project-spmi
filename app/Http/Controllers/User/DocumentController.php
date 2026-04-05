<?php
// app/Http/Controllers/User/DocumentController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\UnitKerja;
use App\Models\Iku;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    protected $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index(Request $request)
    {
        $query = Document::with(['unitKerja'])
            ->where('user_id', auth()->id());

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $documents = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('user.documents.index', compact('documents'));
    }

    public function create()
    {
        $unitKerjas = UnitKerja::where('status', true)->get();
        $ikus = Iku::where('status', true)->get();
        
        return view('user.documents.upload', compact('unitKerjas', 'ikus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:penetapan,pelaksanaan,evaluasi,pengendalian,peningkatan',
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'iku_id' => 'nullable|exists:ikus,id',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png',
        ]);

        try {
            $document = $this->documentService->upload($request->all(), $request->file('file'));

            return redirect()->route('user.documents.index')
                ->with('success', 'Dokumen berhasil diupload dan menunggu verifikasi admin.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupload: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $document = Document::with(['unitKerja', 'iku'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.documents.show', compact('document'));
    }

    public function destroy($id)
    {
        try {
            $document = Document::where('user_id', auth()->id())->findOrFail($id);

            if (!$document->isPending()) {
                return back()->with('error', 'Hanya dokumen Pending yang dapat dihapus.');
            }

            $this->documentService->delete($document);

            return redirect()->route('user.documents.index')
                ->with('success', 'Dokumen berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    public function download($id)
    {
        try {
            $document = Document::where('user_id', auth()->id())->findOrFail($id);

            if (!Storage::disk('public')->exists($document->file_path)) {
                return back()->with('error', 'File tidak ditemukan.');
            }

            return Storage::disk('public')->download($document->file_path, $document->file_name);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal download: ' . $e->getMessage());
        }
    }

    public function preview($id)
    {
        try {
            $document = Document::where('user_id', auth()->id())->findOrFail($id);

            if (!Storage::disk('public')->exists($document->file_path)) {
                return back()->with('error', 'File tidak ditemukan.');
            }

            if ($document->file_extension !== 'pdf') {
                return back()->with('info', 'Preview hanya untuk file PDF.');
            }

            $filePath = Storage::disk('public')->path($document->file_path);
            return response()->file($filePath);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal preview: ' . $e->getMessage());
        }
    }
}