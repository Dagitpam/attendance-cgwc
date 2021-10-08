<?php

namespace Database\Factories;

use App\Allocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\State;
use Illuminate\Support\Str;

class AllocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Allocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        $status = ['allocated','released'];
        return [
            'slug'=>Str::uuid(),
            'amount'=>$this->faker->randomNumber(9, false),
            'state_id'=>State::whereIn('id',[2,8,36])->get()->random(),
            'status'=> $status[rand(0, 1)],
        ];
    }
}
