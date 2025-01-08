<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'long_description',
        'publisher',
        'author',
        'age',
        'reguler_price',
        'sale_price',
        'quantity',
        'image',
        'images',
        'category_id',
        'status',
    ];
    public function getImage()
    {


        $isUrl = Str::isUrl($this->image);
        return $isUrl ? $this->image : asset('admin/product/' . $this->image);
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function items()
    {
        return $this->belongsTo(OrderItem::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);  // Đảm bảo có trường 'order_id' trong bảng 'products'
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id');
    }
}
