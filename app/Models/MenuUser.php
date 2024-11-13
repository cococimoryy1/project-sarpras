<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuUser extends Model
{
    use HasFactory;

    protected $table = 'menu_users';
    protected $fillable = [
        'user_id',  // ID pengguna
        'menu_id',  // ID menu yang diakses
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relasi dengan model Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'jenisUser_id');
    }
}
