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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // relasi one-to-one ke users
            $table->string('nama_usaha', 100);
            $table->text('deskripsi')->nullable();
            $table->string('alamat', 255);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->enum('tipe_tempat', ['warung', 'gerobak', 'kios', 'toko', 'lapak', 'lainnya'])->default('warung');
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->enum('tipe_produk', ['bahan_mentah', 'bahan_matang', 'bahan_olahan', 'campuran'])->default('bahan_mentah');
            $table->string('banner', 255)->nullable();
            $table->string('kontak', 20)->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};