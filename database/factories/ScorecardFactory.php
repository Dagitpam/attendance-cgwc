<?php

namespace Database\Factories;

use App\Scorecard;
use App\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ScorecardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scorecard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category =[
            'Baseline Scorecard',
            '1st Pcu Scorecard'
        ];
        return [
            'slug'=>Str::uuid(),
            'category'=>$category[rand(0, 1)],
            'component_one'=>$this->faker->randomNumber(4, false),
            'component_two'=>$this->faker->randomNumber(4, false),
            'safeguards'=>$this->faker->randomNumber(4, false),
            'm_e'=>$this->faker->randomNumber(4, false),
            'performance'=>$this->faker->randomNumber(4, false),
            'state_id'=>State::all()->random(),
        ];
    }
}
