<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $guard = 'admin';

    protected $fillable = [
        'first_name', 'name', 'email', 'password', 'is_super'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

