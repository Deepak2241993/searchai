<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable=['name','service_slug','short_description','long_description','images',  'price', 'status', 'created_at', 'updated_at','tax'];
}
