<?php

namespace Database\Factories;

use App\Reports;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\State;
use Illuminate\Support\Str;

class ReportsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reports::class;

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
            'community'=>$this->faker->city,
            'activity'=>$this->faker->sentence,
            'indicator'=>$this->faker->sentence,
            'component'=>$this->faker->name,
            'target'=>$this->faker->name,
            'description'=>$this->faker->text,
            'results'=>$this->faker->sentence,
            'challenge'=>$this->faker->text,
            'reported_by'=>$this->faker->name,
            'image'=>'https://app.mcrpbayregistry.org/uploads/520740.95149800 1543058475.JPG'
        ];
    }
}


