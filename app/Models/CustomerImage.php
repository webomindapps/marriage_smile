<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerImage extends Model
{
    use HasFactory;


    protected $fillable = [
        'customers_id',
        'image_url',
    ];
    public function customer()
    {
        return $this->hasOne(Customer::class, 'customers_id');
    }
}
