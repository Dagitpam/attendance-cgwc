<?php

namespace Database\Seeders;

use App\Pump_Borehole;
use Illuminate\Database\Seeder;

class PumpBoreholeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pump_Borehole::factory()
                      ->count(20)
                      ->create();
    }
}
