<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Offer;
use Carbon\Carbon;

class DeleteExpiredOffers extends Command
{
    protected $signature = 'offers:delete-expired';
    protected $description = 'Supprime les offres dont la date limite est dépassée';

    public function handle()
    {
        $deleted = Offer::where('deadline', '<', Carbon::today())->delete();
        $this->info("{$deleted} offre(s) expirée(s) supprimée(s).");
    }
}
