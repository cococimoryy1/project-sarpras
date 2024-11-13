<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTo extends Model
{
    use HasFactory;

    protected $table = 'message_to';
    protected $primaryKey = 'no_record';
    public $timestamps = false;

    protected $fillable = [
        'id_message',
        'to',
        'cc',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
        'delete_mark'

    ];
    // public function message()
    // {
    //     return $this->belongsTo(Message::class, 'message_id', 'message_id'); // Relasi dengan model Message
    // }
    public function message()
{
    return $this->belongsTo(Message::class, 'id_message', 'id'); // Sesuaikan dengan primary key tabel Message
}
}
