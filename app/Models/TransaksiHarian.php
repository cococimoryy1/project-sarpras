<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiHarian extends Model
{
    use HasFactory;

    protected $table = 'T_TRANSAKSI_HARIAN';

    protected $fillable = [
        'NO_RECORDS',
        'STOCK_CODE',
        'DATE_TRANSACTION',
        'OPEN',
        'HIGH',
        'LOW',
        'CLOSE',
        'CHANGE',
        'VOLUME',
        'VALUE',
        'FREQUENCY'
    ];

    protected $dates = ['DATE_TRANSACTION'];
    public function emiten()
    {
        return $this->belongsTo(Emiten::class, 'STOCK_CODE', 'STOCK_CODE');
    }
}
