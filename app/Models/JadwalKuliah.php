<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kuliah'; // Nama tabel di database

    protected $fillable = [
        'mata_kuliah',
        'dosen_pengampu',
        'ruang',
        'hari',
        'jam',
    ];

    // Jika ada relasi dengan model lain, definisikan di sini
}
