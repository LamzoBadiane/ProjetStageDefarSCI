<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'offer_id', 'motivation', 'motivation_file', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
