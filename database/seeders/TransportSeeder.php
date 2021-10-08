<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Transport;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transport::factory()
                 ->count(20)
                 ->create();
    }
}
