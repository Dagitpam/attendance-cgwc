<?php

namespace Database\Factories;

use App\Classroom;
use App\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassroomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Classroom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['initiated','ongoing','completed'];
        return [
            'slug'=>Str::uuid(),
            'name'=>$this->faker->city,
            'address'=>$this->faker->address,
            'number'=>$this->faker->randomNumber(9, false),
            'state_id'=>State::all()->random(),
            'status'=> $status[rand(0, 2)],
        ];
    }
}
