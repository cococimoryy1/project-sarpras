<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'satuan';

    // Primary Key
    protected $primaryKey = 'idsatuan';

    // Kolom yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'nama_satuan',
    ];

    // Relasi ke tabel Barang
    public function barang()
    {
        return $this->hasMany(Barang::class, 'idsatuan', 'idsatuan');
    }
}
