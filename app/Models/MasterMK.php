<?php
// Contoh model MasterMK (app/Models/MasterMK.php)
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterMK extends Model
{
    protected $table = 'master_mk'; // Sesuaikan dengan nama tabel Anda

    protected $primaryKey = 'idmatakuliah'; // Sesuaikan dengan nama primary key tabel

    protected $fillable = ['kode_mk', 'nama_mk', 'sks'];


    // Jika tidak menggunakan timestamp (created_at, updated_at), tambahkan ini
    public $timestamps = false;
}

