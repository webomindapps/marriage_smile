<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPasswordResets extends Model
{
    use HasFactory;
    public $table="password_resets";
    protected $fillable = [
        'email',
        'token'
    ];
}
