<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'barang';

    // Primary Key
    protected $primaryKey = 'idbarang';

    // Kolom yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'nama',
        'harga_satuan',
        'status',
        'idsatuan',
    ];

    // Relasi ke tabel Satuan
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'idsatuan', 'idsatuan');
    }
}
