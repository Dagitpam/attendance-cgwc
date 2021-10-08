<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Investment;

class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Investment::factory()
                ->count(20)
                ->create();
    }
}
