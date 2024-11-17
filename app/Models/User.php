<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel dan primary key
    protected $table = 'users';
    protected $primaryKey = 'iduser';

    // Kolom yang dapat diisi
    protected $fillable = [
        'email',
        'username',
        'password',
        'role_id',
    ];

    // Kolom yang disembunyikan
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    // Tipe data casting
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi ke model Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
