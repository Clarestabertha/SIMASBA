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
        Schema::create('kerusakan', function (Blueprint $table) {
            $table->id('id_kerusakan');
            $table->string('nama_pelapor', 50);
            $table->date('tanggal');
            $table->string('sumber_laporan', 100);
            $table->string('lokasi',50);
            $table->string('deskripsi', 100);
            $table->string('personel');
            $table->date('tgl_perbaikan');
            $table->string('foto_kerusakan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerusakan');
    }
};
