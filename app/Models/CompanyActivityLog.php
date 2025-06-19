<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyActivityLog extends Model
{
    protected $fillable = [
        'company_id',
        'type',    // 'offer_created', 'application_received', etc.
        'message', // Description courte de l'action
        'data',    // Données additionnelles (JSON)
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
