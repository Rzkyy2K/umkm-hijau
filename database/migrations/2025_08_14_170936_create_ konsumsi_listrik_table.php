<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsumsi_listrik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')
                  ->constrained('umkm')
                  ->cascadeOnDelete();

            $table->tinyInteger('bulan')->nullable();
            $table->year('tahun')->nullable();
            $table->decimal('kwh', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsumsi_listrik');
    }
};
