<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'position',
        'status'
    ];
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'feature_plan')->withPivot('feature_value');
        
    }
    public function prices()
    {
        return $this->hasMany(PlanPrice::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
