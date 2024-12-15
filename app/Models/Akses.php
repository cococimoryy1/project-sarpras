<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    use HasFactory;

    protected $table = 'akses';
    // Menambahkan properti primaryKey
    protected $primaryKey = 'akses_id'; // Ganti dengan nama kolom primary key yang sesuai


    protected $fillable = [
        'role_id',
        'menu_id',
        'hak_akses',
    ];

    // Relasi dengan model Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Relasi dengan model Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
