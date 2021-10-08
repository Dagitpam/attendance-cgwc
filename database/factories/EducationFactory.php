<?php

namespace Database\Factories;

use App\Education;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EducationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Education::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $education_levels = ['ND', 'HND', 'NCE', 'BSC', 'MSC', 'PHD'];
        return [
            'slug'=>Str::uuid(),
            'education_level'=>$education_levels[rand(0,5)],
        ];
    }
}
