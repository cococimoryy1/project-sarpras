<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai'; // Nama tabel di basis data

    protected $fillable = ['nama_mahasiswa', 'mata_kuliah', 'nilai']; // Kolom-kolom yang dapat diisi

    // Secara default, Eloquent akan mengasumsikan bahwa tabel memiliki kolom created_at dan updated_at
    // Jika Anda tidak memiliki kolom-kolom ini di tabel Anda, Anda bisa menonaktifkan timestamps seperti berikut:
    public $timestamps = false;

    // Jika Anda memiliki kolom created_at dan updated_at, Anda bisa menggunakan timestamps seperti berikut:
    // protected $timestamps = true;
}
