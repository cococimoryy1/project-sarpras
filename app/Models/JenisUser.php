<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUser extends Model
{
    use HasFactory;

    protected $table = 'jenis_users'; // Pastikan nama tabel sesuai

    protected $primaryKey = 'id_jenis_user';
    protected $fillable = ['id_jenis_user', 'jenis_user', 'create_by', 'create_date','update_date', 'update_by'];
}
