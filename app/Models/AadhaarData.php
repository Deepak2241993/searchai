<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AadhaarData extends Model
{
    use HasFactory;
    protected $fillable = [
        'aadhaar_number',
        'reference_id',
        'id_token',
        'aadhaar_token',
        'name',
        'date_of_birth',
        'gender',
        'mobile',
        'care_of',
        'house',
        'street',
        'district',
        'sub_district',
        'landmark',
        'post_office_name',
        'state',
        'pincode',
        'country',
        'vtc_name',
        'photo_base64',
    ];

    public function aadhaarData()
    {
        return $this->hasOne(AadhaarData::class, 'id_token', 'id');
    }
}
