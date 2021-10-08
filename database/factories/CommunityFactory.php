<?php

namespace Database\Factories;

use App\Community;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\State;
use App\Lga;
use Illuminate\Support\Str;

class CommunityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Community::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $longtitude =[
            '11.68040977',
            '10.2703408',
            '4.960406513',
            '10.29044293',
        ];
        $latitude =[
            '10.19001339',
            '13.2700321',
            '8.330023558',
            '11.16995357'
        ];
        return [
            'slug'=>Str::uuid(),
            'name'=>$this->faker->city,
            'longtitude'=>$longtitude[rand(0, 2)],
            'latitude'=>$latitude[rand(0, 2)],
            'state_id'=>State::all()->random(),
            'lga_id'=>Lga::all()->random()
        ];
    }
}
