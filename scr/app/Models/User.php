<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'user_name',
        'email',
        'phone',
        'status',
        'points_level',
        'created_at',
        'updated_at',
    ];
  
    protected $primaryKey = 'id';
    protected $dates = ['created_at','updated_at'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
