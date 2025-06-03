<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use Carbon\Carbon;

class OfferSeeder extends Seeder
{
    /**
     * Exécute le seeder.
     */
    public function run(): void
    {
        $offers = [
            [
                'title' => 'Développeur Laravel',
                'description' => 'Rejoignez notre équipe pour développer une application web moderne.',
                'domain' => 'Informatique',
                'type' => 'CDI',
                'location' => 'Dakar',
                'deadline' => Carbon::now()->addDays(30),
            ],
            [
                'title' => 'Chargé Marketing Digital',
                'description' => 'Mettez en œuvre des campagnes digitales percutantes.',
                'domain' => 'Marketing',
                'type' => 'Stage',
                'location' => 'Thiès',
                'deadline' => Carbon::now()->addDays(15),
            ],
            [
                'title' => 'Analyste Financier',
                'description' => 'Analyse financière et reporting pour des projets ambitieux.',
                'domain' => 'Finance',
                'type' => 'CDD',
                'location' => 'Saint-Louis',
                'deadline' => Carbon::now()->addDays(45),
            ],
            [
                'title' => 'Community Manager',
                'description' => 'Gérez nos réseaux sociaux avec créativité et engagement.',
                'domain' => 'Communication',
                'type' => 'CDI',
                'location' => 'Ziguinchor',
                'deadline' => Carbon::now()->addDays(20),
            ],
            [
                'title' => 'Consultant RH',
                'description' => 'Participez à l’élaboration et la mise en œuvre des politiques RH.',
                'domain' => 'Ressources Humaines',
                'type' => 'CDD',
                'location' => 'Kaolack',
                'deadline' => Carbon::now()->addDays(25),
            ],
        ];

        foreach ($offers as $offer) {
            Offer::create($offer);
        }
    }
}
