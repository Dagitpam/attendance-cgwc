<?php

namespace Database\Seeders;

use App\Communication;
use Illuminate\Database\Seeder;

class CommunicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Communication::factory()
                      ->count(20)
                      ->create();
    }
}
