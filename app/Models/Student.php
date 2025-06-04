<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cin',
        'first_name',
        'last_name',
        'email',
        'phone',
        'university',
        'level',
        'domain',
        'cv',
        'education',
        'skills',
    ];
}
