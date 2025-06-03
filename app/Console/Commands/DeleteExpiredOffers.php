<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Offer;
use Carbon\Carbon;

class DeleteExpiredOffers extends Command
{
    protected $signature = 'offers:delete-expired';
    protected $description = 'Supprimer automatiquement les offres expirées';

    public function handle()
    {
        $deleted = Offer::where('deadline', '<', Carbon::today())->delete();
        $this->info("{$deleted} offres expirées supprimées.");
    }
}
