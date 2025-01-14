<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    // use HasFactory;
    // public function generateSlug()
    // {
    //     $this->slug = Str::slug($this->top_title, '-');
    // }
    // public static function boot()
    // {
    //     parent::boot();
    //     static::saving(function ($model) {
    //         $model->generateSlug();
    //     });
    // }
    // protected $fillable = ['name', 'image', 'status'];
    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'category_id');
    }
    

    public function getImage()
    {


        $isUrl = Str::isUrl($this->image);
        return $isUrl ? $this->image : asset('/admin/category/' . $this->image);
    }
}
