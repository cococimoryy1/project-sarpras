<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi'; // Nama tabel di basis data

    protected $guarded = []; // Kolom-kolom yang dapat diisi

    // Secara default, Eloquent akan mengasumsikan bahwa tabel memiliki kolom created_at dan updated_at
    // Jika Anda tidak memiliki kolom-kolom ini di tabel Anda, Anda bisa menonaktifkan timestamps seperti berikut:
    public $timestamps = true;

    // Jika Anda memiliki kolom created_at dan updated_at, Anda bisa menggunakan timestamps seperti berikut:
    // protected $timestamps = true;
}
