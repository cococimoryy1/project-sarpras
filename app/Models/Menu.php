<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // app/Models/Menu.php
protected $fillable = [
    'nama_menu',
    'deskripsi_menu',
    'link', // Menambahkan kolom 'link' ke dalam $fillable
];


    public function akses()
{
    return $this->hasMany(Akses::class);
}

}
