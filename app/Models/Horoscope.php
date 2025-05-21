<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model
{
    public $table = "customer_horoscope";
    protected $fillable = ['customer_id', 'image_path'];
}
