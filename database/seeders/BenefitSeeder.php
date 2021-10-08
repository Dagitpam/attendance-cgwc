<?php

namespace Database\Seeders;

use App\Welfare;
use Illuminate\Database\Seeder;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Welfare::factory()
        ->count(20)
        ->create();
    }
}
