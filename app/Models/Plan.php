<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'duration',
        'description',
        'price',
        'thumbnail',
        'position',
        'status'
    ];
}
