<?php

namespace Database\Factories;

use App\Investment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\State;

class InvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type =[
            'Public Buildings',
            'Education',
            'Health',
            'Wash',
            'Roads'
        ];
        $category =[
            'Infrastructure',
            'Capacity Development',
            'Livelyhoods/Transitional Support'
        ];
        return [
            'slug'=>Str::uuid(),
            'amount'=>$this->faker->randomNumber(9, false),
            'type'=>$type[rand(0, 4)],
            'category'=>$category[rand(0, 2)],
            'state_id'=>State::whereIn('id',[2,8,36])->get()->random(),
        ];
    }
}
