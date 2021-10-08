<?php

namespace Database\Factories;

use App\Training;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\State;

class TrainingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Training::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
            $training_type = [
                'Crisis Management',
                'Skill Acquisition',
            ];
            $duration = [
                '6 months',
                '1 year',
                '2 years',
            ];
            return [
                'slug'=>Str::uuid(),
                'name'=>$this->faker->name,
                'state_id'=>State::all()->random(),
                'training_type'=>$training_type[rand(0, 1)],
                'duration'=>$duration[rand(0,2)]
            ];
    }
}
