<?php

namespace Database\Factories;

use App\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class StatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Status::class;

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
        ];
    }
}
