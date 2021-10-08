<?php

namespace Database\Seeders;

use App\Scorecard;
use Illuminate\Database\Seeder;

class ScorecardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scorecard::factory()
                  ->count(20)
                  ->create();
    }
}
