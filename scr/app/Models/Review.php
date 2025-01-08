<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    //

    use HasFactory;
    protected $fillable = ['order_item_id', 'user_id', 'rating', 'comment', 'images', 'status'];


    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
