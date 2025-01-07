<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $fillable = [
        'customer_id',
        'plan_id',
        'plan',
        'duration',
        'start_date',
        'end_date',
        'price',
        'payment_type',
        'payment_id',
        'price',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(PlanPrice::class, 'plan_id');
    }
}
