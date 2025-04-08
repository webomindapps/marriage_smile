<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanPrice extends Model
{
    protected $fillable = [
        'plan_id',
        'duration',
        'price',
        'special_price',
        'status'
    ];

    public function priceplans()
    {
        return $this->belongsTo(Plan::class,'plan_id','id');
    }
}
