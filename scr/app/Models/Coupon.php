<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'coupon_code',
        'coupon_type',
        'coupon_value',
        'cart_value',
        'end_date'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
