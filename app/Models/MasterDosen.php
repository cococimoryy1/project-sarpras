<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterDosen extends Model
{
    protected $table = 'master_dosen'; // Nama tabel yang terhubung dengan model

    protected $fillable = ['kode_dosen', 'nama_dosen', 'email']; // Kolom yang dapat diisi secara massal
}
