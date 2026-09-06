<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->string('target', 100)->default('Semua UMKM');
            $table->enum('prioritas', ['info', 'penting', 'mendesak'])->default('info');
            $table->string('gambar', 255)->nullable();
            $table->dateTime('dari')->nullable();
            $table->dateTime('sampai')->nullable();
            $table->integer('dilihat')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};