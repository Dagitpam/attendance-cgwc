<?php

namespace Database\Factories;

use App\Pump_Borehole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\State;

class Pump_BoreholeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pump_Borehole::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type =[
            'Hand Pump Borehole',
            'Solar Powered Borehole'
        ];
        return [
            'slug'=>Str::uuid(),
            'location'=>$this->faker->city,
            'number'=>$this->faker->randomNumber(9, false),
            'state_id'=>State::all()->random(),
            'type'=>$type[rand(0,1)]
        ];
    }
}
