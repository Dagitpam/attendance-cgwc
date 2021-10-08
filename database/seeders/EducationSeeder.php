<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Education;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Education::factory()
                   ->count(20)
                   ->create();
    }
}
