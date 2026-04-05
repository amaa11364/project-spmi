<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dokumen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkreditasiController extends Controller
{
    public function index(Request $request)
    {
        $dokumen = Dokumen::with(['unitKerja', 'uploader'])
            ->where('tahapan', 'akreditasi')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->search, fn($q) => $q->search($request->search))
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.dashboard.spmi.akreditasi.index', compact('dokumen'));
    }

    public function show($id)
    {
        $dokumen = Dokumen::with(['unitKerja', 'uploader', 'approver'])
            ->where('tahapan', 'akreditasi')
            ->findOrFail($id);

        return view('admin.dashboard.spmi.akreditasi.show', compact('dokumen'));
    }

    public function approve(Request $request, $id)
    {
        $dokumen = Dokumen::where('tahapan', 'akreditasi')->findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'catatan' => 'required_if:status,rejected|string|max:500',
        ]);

        if ($request->status === 'approved') {
            $dokumen->approve(auth()->id(), $request->catatan);
            $message = 'Dokumen disetujui';
        } else {
            $dokumen->reject(auth()->id(), $request->catatan);
            $message = 'Dokumen ditolak';
        }

        return redirect()->back()->with('success', $message);
    }
}
