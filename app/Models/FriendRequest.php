<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status'
    ];

    public function sender()
    {
        return $this->belongsTo(Customer::class, 'sender_id');
    }
}
