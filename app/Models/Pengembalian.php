<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pengembalian';

    // Primary key
    protected $primaryKey = 'pengembalian_id';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali',
        'status_pengembalian',
        'denda',
    ];

    // Relasi dengan model Peminjaman (BelongsTo)
    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
}

