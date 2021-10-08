<?php

namespace Database\Factories;

use App\Grm;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\State;
use App\Lga;
use Illuminate\Support\Str;

class GrmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grm::class;

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
            'lga_id'=>LGA::all()->random(),
            'community'=>$this->faker->city,
            'activity'=>$this->faker->sentence,
            'indicator'=>$this->faker->sentence,
            'component'=>$this->faker->word,
            'brief_grieviance'=>$this->faker->sentence,
            'date_report'=>$this->faker->date,
            'status_griviance'=>$this->faker->sentence,
            'date_resolution'=>$this->faker->date,
            'brief_conclusion'=>$this->faker->text,
            'level_resolution'=>$this->faker->sentence,
            'reported_by'=>$this->faker->name
        ];
    }
}
