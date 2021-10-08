<?php

namespace Database\Factories;

use App\Complain;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\State;

class ComplainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complain::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug'=>Str::uuid(),
            'number'=>$this->faker->randomNumber(9, false),
            'state_id'=>State::all()->random(),
        ];
    }
}
