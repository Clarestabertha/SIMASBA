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
        Schema::create('tindaklanjut', function (Blueprint $table) {
            $table->id('id_tl');
            $table->string('nama_pelapor', 50);
            $table->date('tanggal');
            $table->string('lokasi');
            $table->string('untuk');
            $table->string('deskripsi',100);
            $table->string('personel');
            $table->string('sumber');
            $table->string('foto',500);
            $table->string('status')->default('sedang diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindaklanjut');
    }
};
