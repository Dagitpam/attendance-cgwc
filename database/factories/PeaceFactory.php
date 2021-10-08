<?php

namespace Database\Factories;

use App\Peace;
use App\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PeaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Peace::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug'=>Str::uuid(),
            'name'=>$this->faker->name,
            'state_id'=>State::all()->random(),
            'participant'=>50
        ];
    }
}
