<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'profile_pic',
        'phone',
        'address',
        'alternate_address',
        'note',
        'company_name',
        'gst_number',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
