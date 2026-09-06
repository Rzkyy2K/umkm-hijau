<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->enum('label', ['nonlabel', 'silver', 'gold'])->default('nonlabel')->after('kontak');
            $table->integer('poin')->default(0)->after('label');
        });
    }

    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn(['label', 'poin']);
        });
    }
};