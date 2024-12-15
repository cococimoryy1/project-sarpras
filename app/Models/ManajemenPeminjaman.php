<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'manajemen_peminjaman';

    protected $fillable = [
        'peminjaman_id',
        'status', // pending, diterima, ditolak
        'tanggal_diterima',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
}
