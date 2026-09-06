<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_listrik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade');
            $table->string('bulan', 7); // format YYYY-MM
            $table->decimal('total_kwh', 10, 2);
            $table->string('foto_struk', 255);
            $table->string('foto_alat', 255)->nullable(); // opsional
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->text('alasan')->nullable(); // alasan penolakan
            $table->enum('jenis_penolakan', ['isi_ulang', 'bulan_berikutnya', 'permanen'])->nullable(); // jika declined
            $table->integer('poin')->nullable(); // diisi setelah approved
            $table->enum('label_hasil', ['nonlabel', 'silver', 'gold'])->nullable(); // diisi setelah approved
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_listrik');
    }
};