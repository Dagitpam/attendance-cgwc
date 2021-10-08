<?php

namespace Database\Seeders;

use App\Complain;
use Illuminate\Database\Seeder;

class ComplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Complain::factory()
                 ->count(20)
                 ->create();
    }
}
