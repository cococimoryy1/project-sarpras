<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'message';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'sender',
        'message_text',
        'message_description',
        'messege_status',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'no_mk'
    ];
    // public function messageTo()
    // {
    //     return $this->hasMany(MessageTo::class, 'message_id', 'message_id');
    // }
    public function messageTo()
{
    return $this->hasMany(MessageTo::class, 'id_message', 'id'); // Foreign key 'id_message' di MessageTo sesuai dengan primary key 'id' di Message
}

}
