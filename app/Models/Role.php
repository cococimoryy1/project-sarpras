<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Jika nama tabel tidak sesuai dengan konvensi Laravel, tentukan tabel secara eksplisit
    protected $table = 'roles'; // Ganti dengan nama tabel Anda jika berbeda

    // Tentukan primary key jika tidak mengikuti konvensi Laravel (ID)
    protected $primaryKey = 'id'; // Ganti dengan primary key tabel Anda

    // Jika primary key bukan auto-incrementing integer
    public $incrementing = true; // Set false jika bukan auto-incrementing

    // Tentukan tipe primary key jika bukan integer
    protected $keyType = 'string'; // Misalnya jika primary key adalah string

    // Tentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'name', // Ganti dengan nama kolom yang relevan
        'description', // Ganti dengan nama kolom yang relevan
    ];

    // Definisikan relasi ke model User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
