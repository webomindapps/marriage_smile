<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortlist extends Model
{
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id','profile_id');
    }
}
