<?php

namespace Database\Factories;

use App\Tracker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\State;
use Illuminate\Support\Str;

class TrackerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tracker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug'=>Str::uuid(),
            'state_id'=>State::all()->random(),
            'indicator'=>$this->faker->sentence,
            'female'=>$this->faker->randomNumber(9,false),
            'male'=>$this->faker->randomNumber(9,false),
            'other'=>$this->faker->randomNumber(9,false)
        ];
    }
}
