<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'domain',
        'type',
        'location',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function isExpired()
    {
        return Carbon::now()->gt(Carbon::parse($this->deadline));
    }
}
