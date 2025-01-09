<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'customers_id',
        'nationality',
        'religion',
        'gender',
        'height',
        'colour',
        'qualification',
        'other_qualification',
        'dob',
        'age',
        'mother_tongue',
        'other_mothertongue',
        'caste',
        'annual_income',
        'company_name',
        'experience',
        'req_rel_manager',
        'expectations',
        'gotra',
        'sun_star',
        'birth_star',
        'aadhar_no',
        'image_path',
        'hobbies',
        'marritialstatus',
        'no_of_children',
        'father_name',
        'mother_name',
        'father_occupation',
        'mother_occupation',
        'siblings',
        'locations',
        'present_house_status',
        'permanent_locations',
        'permanent_house_status',
        'asset_value',
        'preferreday',
        'timings',
        'preferred_contact_no',
        'contact_related_to',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id', 'id');
    }
    public function sibilingdetails()
    {
        return $this->hasMany(CustomerRelation::class, 'customers_id');
    }
}
