<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publish extends Model
{
    use HasFactory;
    protected $table = 'publishers';
    protected $fillable = [
        'publish_name',
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
