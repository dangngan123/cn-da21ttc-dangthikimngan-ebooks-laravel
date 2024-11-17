<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'book_title',
        'description',
        'thumbnail',
        'quantity',
        'price',
        'discount',
        'discontinued',
        'is_featured',
        'author_id',
        'category_id',
        'publish_id',
        'supplier_id',
        'created_at',
        'updated_at',
    ];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $dates = ['created_at','updated_at'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
