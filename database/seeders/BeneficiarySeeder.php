<?php

namespace Database\Seeders;

use App\Beneficiary;
use Illuminate\Database\Seeder;

class BeneficiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Beneficiary::factory()
                   ->count(20)
                   ->create();
    }
}
