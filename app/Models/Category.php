<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Nama tabel di database
    protected $primaryKey = 'id_kategori'; // Primary key tabel

    protected $fillable = [
        'nama_kategori', // Pastikan ini sesuai dengan kolom di tabel
    ];

    public $timestamps = true; // Mengaktifkan timestamps (created_at, updated_at)

    // Relasi dengan model Barang
    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'kategori_barang_id', 'id_kategori');
    }
}
