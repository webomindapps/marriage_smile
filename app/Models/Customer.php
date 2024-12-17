<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = [
        'customer_id',
        'name',
        'nationality',
        'religion',
        'qualification',
        'dob',
        'mother_tongue',
        'caste',
        'sub_caste',
        'gotra',
        'sun_star',
        'birth_star',
        'annual_income',
        'company_name',
        'experience',
        'phone',
        'email',
        'password',
        'conf_password',
        'aadhar_no',
        'hobbies',
        'facebook_profile',
        'image_path',
        'marritialstatus',
        'no_of_children',
        'req_rel_manager',
        'expectations',
        'father_name',
        'mother_name',
        'father_occupation',
        'mother_occupation',
        'siblings',
        'locations',
        'permanent_locations',
        'house_status',
        'asset_value',
        'preferreday',
        'timings',
        'preferred_contact_no',
        'contact_related_to',
        'email_verified_at',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
