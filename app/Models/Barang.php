<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs'; // Nama tabel barang
    protected $primaryKey = 'barang_id'; // Primary key untuk barang
    protected $fillable = [
        'nama_barang',
        'deskripsi_barang',
        'kategori_barang_id', // Ensure this is filled as well
        'jumlah_total',
    ];

    // Relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_barang_id', 'id_kategori');
    }
    public function ketersediaan()
    {
        return $this->hasOne(KetersediaanBarang::class, 'barang_id', 'barang_id');
    }
}
