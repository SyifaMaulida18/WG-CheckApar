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
        Schema::create('apars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_seri')->unique();
            $table->string('jenis_apar');
            $table->string('kapasitas');
            $table->string('kepemilikan');
            $table->string('gedung');
            $table->string('lantai');
            $table->string('koordinat_x');
            $table->string('koordinat_y');
            $table->string('status_posisi');
            $table->date('tanggal_kadaluarsa');
            $table->string('status_inspeksi')->default('non-aktif');
            $table->string('qr_code_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apars');
    }
};
