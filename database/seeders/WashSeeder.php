<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Wash;

class WashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wash::factory()
            ->count(20)
            ->create();
    }
}
