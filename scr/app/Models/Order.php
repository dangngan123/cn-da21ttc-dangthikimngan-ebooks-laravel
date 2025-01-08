<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    // public function getFormattedIdAttribute(): string
    // {
    //     return str_pad($this->id, 8, '0', STR_PAD_LEFT); // Thêm số 0 ở đầu
    // }
    protected $fillable = [
        // các trường khác
        'coupon_id'
    ];
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'order_id');  // Thêm trường 'order_id' vào bảng 'products' (nếu có)
    }
}
