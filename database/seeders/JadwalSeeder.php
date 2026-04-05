<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = [
            [
                'nama_kegiatan' => 'Workshop Implementasi SPMI',
                'deskripsi' => 'Workshop tentang implementasi Sistem Penjaminan Mutu Internal',
                'tanggal' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'waktu_mulai' => '09:00:00',
                'waktu_selesai' => '16:00:00',
                'lokasi' => 'Ruang Rapat Utama',
                'penanggung_jawab' => 'LP3M',
                'urutan' => 1,
                'is_active' => true,
                'kategori' => 'workshop',
            ],
            [
                'nama_kegiatan' => 'Rapat Koordinasi Mutu',
                'deskripsi' => 'Rapat koordinasi tim penjaminan mutu',
                'tanggal' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'waktu_mulai' => '13:00:00',
                'waktu_selesai' => '15:00:00',
                'lokasi' => 'Ruang Rapat LP3M',
                'penanggung_jawab' => 'Ketua LP3M',
                'urutan' => 2,
                'is_active' => true,
                'kategori' => 'rapat',
            ],
            [
                'nama_kegiatan' => 'Pelatihan Auditor Mutu',
                'deskripsi' => 'Pelatihan untuk auditor mutu internal',
                'tanggal' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'waktu_mulai' => '08:30:00',
                'waktu_selesai' => '17:00:00',
                'lokasi' => 'Aula Utama',
                'penanggung_jawab' => 'Biro SPM',
                'urutan' => 3,
                'is_active' => true,
                'kategori' => 'pelatihan',
            ],
        ];

        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }
    }
}