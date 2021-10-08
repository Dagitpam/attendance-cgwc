<?php

namespace Database\Seeders;

use App\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Social::factory()
        ->count(20)
        ->create();
    }
}
