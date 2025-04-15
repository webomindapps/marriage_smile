<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionValidation extends Model
{
    protected $table = 'subscription_validation';

    protected $fillable = [
        'customer_id',
        'plan_id',
        'subscription_id',
        'photo_viewable',
        'profile_viewable',
        'hscop_viewable',
        'chat_viewable'
    ];
}
