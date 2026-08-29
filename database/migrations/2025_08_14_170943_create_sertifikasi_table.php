<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sertifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm')
                  ->constrained('umkm')
                  ->cascadeOnDelete();

            $table->foreignId('penilaian_id')
                  ->constrained('penilaian')
                  ->cascadeOnDelete();

            $table->enum('label', ['silver', 'gold'])->nullable();
            $table->string('nomor_sertifikat', 100)->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->enum('status', [
                'aktif',
                'kadaluarsa',
            ])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikasi');
    }
};
