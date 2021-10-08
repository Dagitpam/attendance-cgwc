<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\State;
use Illuminate\Support\Str;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = State::insert([
            ['id' => 1, 'slug'=>Str::uuid(),'code' => 'ABI', 'name' => 'Abia'],
            ['id' => 2, 'slug'=>Str::uuid(),'code' => 'ADA', 'name' => 'Adamawa'],
            ['id' => 3, 'slug'=>Str::uuid(),'code' => 'AKW', 'name' => 'Akwa Ibom'],
            ['id' => 4, 'slug'=>Str::uuid(),'code' => 'ANA', 'name' => 'Anambra'],
            ['id' => 5, 'slug'=>Str::uuid(),'code' => 'BAU', 'name' => 'Bauchi'],
            ['id' => 6, 'slug'=>Str::uuid(),'code' => 'BAY', 'name' => 'Bayelsa'],
            ['id' => 7, 'slug'=>Str::uuid(),'code' => 'BEN', 'name' => 'Benue'],
            ['id' => 8, 'slug'=>Str::uuid(),'code' => 'BOR', 'name' => 'Borno'],
            ['id' => 9, 'slug'=>Str::uuid(),'code' => 'CRO', 'name' => 'Cross River'],
            ['id' => 10, 'slug'=>Str::uuid(), 'code' => 'DEL', 'name' => 'Delta'],
            ['id' => 11, 'slug'=>Str::uuid(), 'code' => 'EBO', 'name' => 'Ebonyi'],
            ['id' => 12, 'slug'=>Str::uuid(), 'code' => 'EDO', 'name' => 'Edo'],
            ['id' => 13, 'slug'=>Str::uuid(), 'code' => 'EKI', 'name' => 'Ekiti'],
            ['id' => 14, 'slug'=>Str::uuid(), 'code' => 'RIV', 'name' => 'Rivers'],
            ['id' => 15, 'slug'=>Str::uuid(), 'code' => 'ENU', 'name' => 'Enugu'],
            ['id' => 16, 'slug'=>Str::uuid(), 'code' => 'ABU', 'name' => 'Abuja'],
            ['id' => 17, 'slug'=>Str::uuid(), 'code' => 'GOM', 'name' => 'Gombe'],
            ['id' => 18, 'slug'=>Str::uuid(), 'code' => 'IMO', 'name' => 'Imo'],
            ['id' => 19, 'slug'=>Str::uuid(), 'code' => 'JIG', 'name' => 'Jigawa'],
            ['id' => 20, 'slug'=>Str::uuid(), 'code' => 'KAD', 'name' => 'Kaduna'],
            ['id' => 21, 'slug'=>Str::uuid(), 'code' => 'KAN', 'name' => 'Kano'],
            ['id' => 22, 'slug'=>Str::uuid(), 'code' => 'KAT', 'name' => 'Katsina'],
            ['id' => 23, 'slug'=>Str::uuid(), 'code' => 'KEB', 'name' => 'Kebbi'],
            ['id' => 24, 'slug'=>Str::uuid(), 'code' => 'KOG', 'name' => 'Kogi'],
            ['id' => 25, 'slug'=>Str::uuid(), 'code' => 'KWA', 'name' => 'Kwara'],
            ['id' => 26, 'slug'=>Str::uuid(), 'code' => 'LAG', 'name' => 'Lagos'],
            ['id' => 27, 'slug'=>Str::uuid(), 'code' => 'NAS', 'name' => 'Nassarawa'],
            ['id' => 28, 'slug'=>Str::uuid(), 'code' => 'NIG', 'name' => 'Niger'],
            ['id' => 29, 'slug'=>Str::uuid(), 'code' => 'NIG', 'name' => 'Ogun'],
            ['id' => 30, 'slug'=>Str::uuid(), 'code' => 'OND', 'name' => 'Ondo'],
            ['id' => 31, 'slug'=>Str::uuid(), 'code' => 'OSU', 'name' => 'Osun'],
            ['id' => 32, 'slug'=>Str::uuid(), 'code' => 'OYO', 'name' => 'Oyo'],
            ['id' => 33, 'slug'=>Str::uuid(), 'code' => 'PLA', 'name' => 'Plateau'],
            ['id' => 34, 'slug'=>Str::uuid(), 'code' => 'SOK', 'name' => 'Sokoto'],
            ['id' => 35, 'slug'=>Str::uuid(), 'code' => 'TAR', 'name' => 'Taraba'],
            ['id' => 36, 'slug'=>Str::uuid(), 'code' => 'YOB', 'name' => 'Yobe'],
            ['id' => 37, 'slug'=>Str::uuid(), 'code' => 'ZAM', 'name' => 'Zamfara'],
        ]);
    }
}
