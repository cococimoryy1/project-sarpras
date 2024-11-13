<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jenis_user', // ID dari jenis_user
        'menu_id',       // ID dari menu
    ];

    // Relasi ke Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id'); // Mengaitkan ke tabel Menu
    }

    // Relasi ke JenisUser
    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'jenis_user_id', 'id_jenis_user');
    }

    // Jika ingin relasi many-to-many dengan Menu
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_level', 'menu_level_id', 'menu_id');
    }
}


