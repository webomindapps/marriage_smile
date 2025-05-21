<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'password',
        'phone',
        'conf_password',
        'email_verified_at',
        'last_login_time',
    ];

    public function details()
    {
        return $this->hasOne(CustomerDetails::class, 'customers_id');
    }
    public function documents()
    {
        return $this->hasMany(CustomerImage::class, 'customers_id');
    }
    public function horoscope()
    {
        return $this->hasMany(Horoscope::class, 'customer_id');
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'customer_id');
    }
 
}
