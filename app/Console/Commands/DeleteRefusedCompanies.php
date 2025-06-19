<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use Carbon\Carbon;

class DeleteRefusedCompanies extends Command {
    protected $signature = 'companies:delete-refused';
    protected $description = 'Supprime les entreprises refusées depuis 2h ou plus';

    public function handle() {
        $limit = Carbon::now()->subHours(2);

        $deleted = Company::where('status', 'refusée')
            ->where('rejected_at', '<=', $limit)
            ->delete();

        $this->info("$deleted entreprises supprimées.");
    }
}