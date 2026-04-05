<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '081234567890',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Buat Akun User 1
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Biasa',
                'email' => 'user@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'phone' => '081234567891',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Buat Akun User 2 (Staf)
        User::updateOrCreate(
            ['email' => 'staf@example.com'],
            [
                'name' => 'Staf Unit',
                'email' => 'staf@example.com',
                'password' => Hash::make('staf123'),
                'role' => 'user',
                'phone' => '081234567892',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Buat Akun User 3 (Dosen)
        User::updateOrCreate(
            ['email' => 'dosen@example.com'],
            [
                'name' => 'Dosen Pengajar',
                'email' => 'dosen@example.com',
                'password' => Hash::make('dosen123'),
                'role' => 'user',
                'phone' => '081234567893',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Buat Akun User 4 (Mahasiswa)
        User::updateOrCreate(
            ['email' => 'mahasiswa@example.com'],
            [
                'name' => 'Mahasiswa',
                'email' => 'mahasiswa@example.com',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user',
                'phone' => '081234567894',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->command->info('✅ User berhasil dibuat!');
        $this->command->info('📧 Admin Email: admin@example.com | Password: admin123');
        $this->command->info('📧 User Email: user@example.com | Password: user123');
        $this->command->info('📧 Staf Email: staf@example.com | Password: staf123');
        $this->command->info('📧 Dosen Email: dosen@example.com | Password: dosen123');
        $this->command->info('📧 Mahasiswa Email: mahasiswa@example.com | Password: mahasiswa123');
    }
}