<?php
// app/Services/DocumentService.php

namespace App\Services;

use App\Models\Dokumen;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DocumentService
{
    /**
     * Upload and create document
     */
    public function upload(array $data, UploadedFile $file): Dokumen
    {
        return DB::transaction(function () use ($data, $file) {
            // Generate folder path
            $folderPath = 'dokumen/' . $data['category'] . '/' . date('Y');
            
            // Generate filename
            $fileName = Str::slug($data['title']) . '_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            
            // Store file
            $filePath = $file->storeAs($folderPath, $fileName, 'public');

            // Create document
            return Dokumen::create([
                'user_id' => auth()->id(),
                'unit_kerja_id' => $data['unit_kerja_id'],
                'iku_id' => $data['iku_id'] ?? null,
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'category' => $data['category'],
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_extension' => $file->getClientOriginalExtension(),
                'status' => 'pending',
                'metadata' => $this->collectMetadata($data['category'], $data),
            ]);
        });
    }

    /**
     * Collect metadata based on category
     */
    private function collectMetadata(string $category, array $data): array
    {
        $metadata = [];

        switch ($category) {
            case 'penetapan':
                if (isset($data['kode_penetapan'])) {
                    $metadata['kode_penetapan'] = $data['kode_penetapan'];
                }
                if (isset($data['tahun_penetapan'])) {
                    $metadata['tahun_penetapan'] = $data['tahun_penetapan'];
                }
                if (isset($data['status_penetapan'])) {
                    $metadata['status_penetapan'] = $data['status_penetapan'];
                }
                break;

            case 'pelaksanaan':
                if (isset($data['periode_pelaksanaan'])) {
                    $metadata['periode_pelaksanaan'] = $data['periode_pelaksanaan'];
                }
                if (isset($data['lokasi'])) {
                    $metadata['lokasi'] = $data['lokasi'];
                }
                break;

            case 'evaluasi':
                if (isset($data['periode_evaluasi'])) {
                    $metadata['periode_evaluasi'] = $data['periode_evaluasi'];
                }
                if (isset($data['hasil_evaluasi'])) {
                    $metadata['hasil_evaluasi'] = $data['hasil_evaluasi'];
                }
                break;

            case 'pengendalian':
                if (isset($data['sumber_temuan'])) {
                    $metadata['sumber_temuan'] = $data['sumber_temuan'];
                }
                if (isset($data['prioritas'])) {
                    $metadata['prioritas'] = $data['prioritas'];
                }
                if (isset($data['target_selesai'])) {
                    $metadata['target_selesai'] = $data['target_selesai'];
                }
                break;

            case 'peningkatan':
                if (isset($data['program_peningkatan'])) {
                    $metadata['program_peningkatan'] = $data['program_peningkatan'];
                }
                if (isset($data['anggaran'])) {
                    $metadata['anggaran'] = $data['anggaran'];
                }
                if (isset($data['jenis_peningkatan'])) {
                    $metadata['jenis_peningkatan'] = $data['jenis_peningkatan'];
                }
                break;
        }

        return $metadata;
    }

    /**
     * Delete document and its file
     */
    public function delete(Dokumen $dokumen): bool
    {
        return DB::transaction(function () use ($dokumen) {
            // Delete file
            if (Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            // Delete record
            return $dokumen->delete();
        });
    }

    /**
     * Get statistics
     */
    public function getStatistics(): array
    {
        $total = Dokumen::count();
        $pending = Dokumen::where('status', 'pending')->count();
        $approved = Dokumen::where('status', 'approved')->count();
        $rejected = Dokumen::where('status', 'rejected')->count();

        $byCategory = Dokumen::select('category', \DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        return [
            'total' => $total,
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected,
            'by_category' => $byCategory,
        ];
    }
}