<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Car Company est un utilisateur
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'sector',
        'description',
        'logo',
        'contact_name',
        'contact_email',
        'contact_phone',
        'address',
        'city',
        'postal_code',
        'country',
        'email',
        'password',

        // Champs de vérification supplémentaires
        'ninea',
        'rccm',
        'company_story',
        'document',
        'status', // 'pending', 'validated', 'rejected'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relations
    public function offers()
    {
        return $this->hasMany(\App\Models\Offer::class);
    }

    public function applications()
    {
        return $this->hasManyThrough(\App\Models\Application::class, \App\Models\Offer::class);
    }

    public function interviews()
    {
        return $this->hasMany(\App\Models\Interview::class);
    }
}
