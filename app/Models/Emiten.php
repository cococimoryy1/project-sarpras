<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emiten extends Model
{
    use HasFactory;

    protected $table = 'EMITEN';

    protected $fillable = [
        'STOCK_CODE',
        'NAMA_PERUSAHAAN',
        'SHARED',
        'SEKTOR'
    ];
}

