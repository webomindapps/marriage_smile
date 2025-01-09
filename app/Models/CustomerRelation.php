<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerRelation extends Model
{
    protected $fillable = [
        'customers_id',
        'child_gender',
        'child_age',
        'sibling_maritial_status',
        'sibling_age_relation',
    ];
}
