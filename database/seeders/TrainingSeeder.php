<?php

namespace Database\Seeders;

use App\Training;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Training::factory()
                ->count(20)
                ->create();
    }
}
