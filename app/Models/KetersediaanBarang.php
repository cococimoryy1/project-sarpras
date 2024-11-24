<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KetersediaanBarang extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'ketersediaan_barang';

    // Primary key
    protected $primaryKey = 'ketersediaan_id';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'barang_id',
        'status_tersedia',
        'tanggal_terakhir_update',
        'jumlah_tersedia', // Tambahkan kolom jumlah_tersedia di sini
    ];

    // Relasi dengan model Barang
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
