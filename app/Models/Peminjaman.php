<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'peminjaman';

    // Primary key
    protected $primaryKey = 'peminjaman_id';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status_peminjaman',
        'total_hari',
    ];

    // Relasi dengan model User (BelongsTo)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    // Relasi dengan PeminjamanDetail (HasMany)
    public function peminjamanDetail(): HasMany
    {
        return $this->hasMany(PeminjamanDetail::class, 'peminjaman_id');
    }
    public function details()
{
    return $this->hasMany(PeminjamanDetail::class, 'peminjaman_id');
}
public function markAsReturned($tanggalKembali)
{
    $this->tanggal_kembali_sebenarnya = $tanggalKembali;
    $this->status_peminjaman = 'selesai';
    $this->save();
}


}
