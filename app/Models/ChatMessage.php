<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'text'];

    public function sender()
    {
        return $this->belongsTo(Customer::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Customer::class, 'receiver_id');
    }
}
