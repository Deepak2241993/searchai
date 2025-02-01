<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',     
        'razorpay_order_id',     
        'amount',
        'currency',
        'status',
        'tokens_purchased',
        'service_names',
        'tokens',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}
