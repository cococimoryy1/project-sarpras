<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'barang_id';

    protected $fillable = [
        'nama_barang',
        'deskripsi_barang',
        'kategori_barang',
        'status_barang',
        'jumlah_total',
        'jumlah_tersedia',
    ];




}
