<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tindaklanjut', function (Blueprint $table) {
        $table->unsignedBigInteger('id_kerusakan')->nullable(); // Tambahkan kolom id_kerusakan
        $table->foreign('id_kerusakan')->references('id_kerusakan')->on('kerusakan')->onDelete('cascade'); // Definisikan foreign key
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('tindaklanjut', function (Blueprint $table) {
        $table->dropForeign(['id_kerusakan']); // Hapus foreign key
        $table->dropColumn('id_kerusakan'); // Hapus kolom id_kerusakan
    });
}

};
