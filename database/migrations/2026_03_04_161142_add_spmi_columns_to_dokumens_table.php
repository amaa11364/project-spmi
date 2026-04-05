<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dokumens', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada sebelum menambah
            if (!Schema::hasColumn('dokumens', 'category')) {
                $table->enum('category', [
                    'penetapan', 'pelaksanaan', 'evaluasi', 
                    'pengendalian', 'peningkatan'
                ])->nullable()->after('jenis_dokumen');
            }
            
            if (!Schema::hasColumn('dokumens', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])
                      ->default('pending')->after('category');
            }
            
            if (!Schema::hasColumn('dokumens', 'admin_note')) {
                $table->text('admin_note')->nullable()->after('status');
            }
            
            if (!Schema::hasColumn('dokumens', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()
                      ->constrained('users')->after('admin_note');
            }
            
            if (!Schema::hasColumn('dokumens', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('approved_by');
            }
            
            // HAPUS BAGIAN METADATA KARENA SUDAH ADA!
            // $table->json('metadata')->nullable()->after('approved_at');
            
            if (!Schema::hasColumn('dokumens', 'deleted_at')) {
                $table->softDeletes()->after('updated_at');
            }
            
            // Index
            $table->index(['category', 'status']);
        });
    }

    public function down()
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropColumn([
                'category', 'status', 'admin_note', 
                'approved_by', 'approved_at'
            ]);
            $table->dropSoftDeletes();
            $table->dropIndex(['category', 'status']);
            
            // JANGAN DROP METADATA! karena itu kolom lama
        });
    }
};