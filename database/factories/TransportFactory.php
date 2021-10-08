<?php

namespace Database\Factories;

use App\Communication;
use App\Transport;
use App\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = [
            'Road',
            'Bridge'
        ];
        return [
            'slug'=>Str::uuid(),
            'state_id'=>State::whereIn('id',[2,8,36])->get()->random(),
            'location'=>$this->faker->city,
            'type'=>$type[rand(0, 1)],
            'number'=>50
        ];
    }
}
