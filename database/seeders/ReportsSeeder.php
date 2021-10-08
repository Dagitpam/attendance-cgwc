<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Reports;

class ReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reports::factory()
                ->count(20)
                ->create();
    }
}
