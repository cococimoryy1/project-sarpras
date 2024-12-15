<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'deskripsi_menu',
        'link',
        'parent_id',
    ];

    // Relasi ke submenu (children)
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    // Relasi ke menu utama (parent)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Relasi ke Akses
    public function akses()
    {
        return $this->hasMany(Akses::class, 'menu_id');
    }
    // Di model Akses
public function menu()
{
    return $this->belongsTo(Menu::class, 'menu_id', 'id');
}
}


