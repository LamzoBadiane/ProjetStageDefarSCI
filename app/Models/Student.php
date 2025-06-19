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
    public function applications()
    {
        return $this->hasMany(\App\Models\Application::class, 'user_id', 'user_id');
    }
    public function interviews()
    {
        return $this->hasMany(\App\Models\Interview::class, 'user_id', 'user_id');
    }

}
