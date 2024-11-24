<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeminjamanDetail extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'peminjaman_detail';

    // Primary key
    protected $primaryKey = 'peminjaman_detail_id';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'peminjaman_id',
        'barang_id',
        'jumlah_barang',
    ];

    // Relasi dengan model Peminjaman (BelongsTo)
    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    // Relasi dengan model Barang (BelongsTo)
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}

