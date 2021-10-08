<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Tracker;

class TrackerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tracker::factory()
                ->count(20)
                ->create();
    }
}
