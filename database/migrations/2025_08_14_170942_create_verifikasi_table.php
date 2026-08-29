<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')
                  ->constrained('umkm')
                  ->cascadeOnDelete();

            $table->foreignId('verifier_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->date('tanggal_verifikasi')->nullable();
            $table->enum('status', [
                'pending',
                'disetujui',
                'ditolak',
            ])->default('pending');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifikasi');
    }
};
