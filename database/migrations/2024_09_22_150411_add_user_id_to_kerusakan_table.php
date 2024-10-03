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
        Schema::table('kerusakan', function (Blueprint $table) {
            // Menambahkan kolom user_id
            $table->unsignedBigInteger('user_id')->after('id_kerusakan');

            // Menambahkan foreign key ke tabel users
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); // Pilihan 'cascade' untuk menghapus kerusakan jika user dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerusakan', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['user_id']);
            
            // Drop kolom user_id
            $table->dropColumn('user_id');
        });
    }
};
