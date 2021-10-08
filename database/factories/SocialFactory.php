<?php

namespace Database\Factories;

use App\Social;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\State;
use Illuminate\Support\Str;

class SocialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Social::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $participant_type = [
            'Social cohesion activity participant',
            'Peace group participant',
            'Peace groups formed or supported by project',
            'Psycho social support',
        ];
        return [
            'slug'=>Str::uuid(),
            'number'=>$this->faker->randomNumber(9, false),
            'state_id'=>State::whereIn('id',[2,8,36])->get()->random(),
            'participant_type'=>$participant_type[rand(0, 3)]
        ];
    }
}
