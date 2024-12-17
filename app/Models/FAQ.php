<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    public $table='faqs';
    protected $fillable=['question','answer','position','status'];
}
