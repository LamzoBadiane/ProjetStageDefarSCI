<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function favorites() {
        return $this->belongsToMany(Offer::class, 'favorites')->withTimestamps();
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
        }
    public function student()
    {
        return $this->hasOne(\App\Models\student::class);
    }
    public function fullName()
    {
        if ($this->student) {
            return $this->student->first_name . ' ' . $this->student->last_name;
        }

        return $this->name;
    }

}
