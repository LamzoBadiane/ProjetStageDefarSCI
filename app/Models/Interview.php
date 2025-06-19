<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'company_id',
        'user_id',
        'application_id',
        'date',
        'time',
        'mode',
        'location',
        'message',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
