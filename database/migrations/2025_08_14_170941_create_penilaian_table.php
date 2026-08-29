<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')
                  ->constrained('umkm')
                  ->cascadeOnDelete();
            $table->foreignId('audit_id')
                  ->constrained('audit_listrik')
                  ->cascadeOnDelete();

            $table->decimal('skor_energi', 5, 2)->nullable();
            $table->decimal('skor_teknologi', 5, 2)->nullable();
            $table->decimal('skor_lingkungan', 5, 2)->nullable();
            $table->decimal('skor_total', 5, 2)->nullable();
            $table->enum('hasil', [
                'lulus',
                'tidak lulus',
                'proses',
            ])->default('proses');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
