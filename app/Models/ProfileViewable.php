<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileViewable extends Model
{
    protected $table = 'profile_view';

    protected $fillable = [
        'customer_id',
        'plan_id',
        'subscription_id',
        'profile_id',
       
    ];
}
