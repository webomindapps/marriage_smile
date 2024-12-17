<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    public $table='testimonials';
    protected $fillable=['name','comments','image_url'];
}
