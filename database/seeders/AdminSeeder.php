<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'first_name' => 'Lamine',
            'name' => 'Badiane',
            'email' => 'admin@admin.com',
            'password' => Hash::make('passer123'),
            'is_super' => true,
        ]);
    }
}
