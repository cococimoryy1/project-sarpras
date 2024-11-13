<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // protected $table = 'users'; // Pastikan ini adalah nama tabel yang benar
    // protected $primaryKey = 'id_user'; // Menetapkan kolom kunci utama

    protected $fillable = [
        'nama_user', 'username', 'email', 'password', 'id_jenis_user',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }


    public function jenis_user()
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user');
    }

}

