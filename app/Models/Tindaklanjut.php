<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindaklanjut extends Model
{
    use HasFactory;

    // Jika tabel yang digunakan tidak sesuai dengan nama default
    protected $table = 'tindaklanjut';

    // Jika tabel tidak menggunakan timestamp
    public $timestamps = true;
    protected $primaryKey = 'id_tl';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_pelapor',
        'tanggal',
        'lokasi',
        'untuk',
        'deskripsi',
        'personel',
        'sumber',
        'foto',
        'status',
    ];
    protected $attributes = [
        'status' => 'sedang diproses',
    ];
}
