<?php

namespace Database\Factories;

use App\Wash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\State;

class WashFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wash::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $wash_type = [
            'Solar Powered Boreholes',
            'Hand Pumped Boreholes',
            'Rehabilitation Of Water Supply System',
            'Rehabilitation Of Water Supply Sources',
            'Vip Laterines'
        ];
        return [
            'slug'=>Str::uuid(),
            'number'=>$this->faker->randomNumber(9, false),
            'wash_type'=>$wash_type[rand(0,4)],
            'state_id'=>State::all()->random(),
        ];
    }
}
