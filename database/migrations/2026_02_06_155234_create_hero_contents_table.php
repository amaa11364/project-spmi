<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hero_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('cta_text')->nullable()->comment('Call to Action Text');
            $table->string('cta_link')->nullable()->comment('Call to Action Link');
            $table->string('background_image')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        // Tambahkan index untuk is_active untuk query yang lebih cepat
        Schema::table('hero_contents', function (Blueprint $table) {
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_contents');
    }
};