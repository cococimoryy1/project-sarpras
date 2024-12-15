<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenPengembalian extends Model
{
    use HasFactory;

    protected $table = 'manajemen_pengembalian';

    protected $fillable = [
        'pengembalian_id',
        'status', // proses, selesai
        'tanggal_selesai',
    ];

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class, 'pengembalian_id');
    }
}
