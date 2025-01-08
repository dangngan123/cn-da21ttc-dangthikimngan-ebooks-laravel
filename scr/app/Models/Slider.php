<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Slider extends Model
{


    use HasFactory;
    // protected $fillable = [
    //     'top_title',   // Thêm trường này vào
    //     'title',
    //     'sub_title',
    //     'link',
    //     'offer',
    //     'image',
    //     'status',
    //     'type',
    //     'start_date',
    //     'end_date',
    // ];
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



    public function getImage()
    {


        $isUrl = Str::isUrl($this->image);
        return $isUrl ? $this->image : asset('admin/slider/' . $this->image);
    }
}
