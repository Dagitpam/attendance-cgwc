<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Beneficiary;
use App\Education;
use App\Welfare;
use App\State;
use App\Lga;
use App\Community;
use App\Status;
use Illuminate\Support\Str;

class BeneficiaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Beneficiary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = ['male', 'female'];
        return [
            'slug'=>Str::uuid(),
            'firstname'=>$this->faker->name,
            'middlename'=>$this->faker->name,
            'lastname'=>$this->faker->name,
            'gender'=>$gender[rand(0, 1)],
            'age'=>$this->faker->randomDigit,
            'occupation'=>$this->faker->company,
            'phone'=>$this->faker->phoneNumber,
            'education_id'=>Education::all()->random(),
            'benefit_id'=>Welfare::all()->random(),
            'status_id'=>Status::all()->random(),
            'state_id'=>State::whereIn('id', [2,8,36])->get()->random(),
            'lga_id'=>Lga::all()->random(),
            'community_id'=>Community::all()->random()
        ];
    }
}
