<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['customer_id', 'image_path'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
