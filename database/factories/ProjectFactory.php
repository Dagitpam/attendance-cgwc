<?php

namespace Database\Factories;

use App\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\State;
use App\Community;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $longtitude = [
            11.68040977,
            10.2703408,
            4.960406513,
            10.29044293,
        ];
        $latitude = [
            10.19001339,
            13.2700321,
            8.330023558,
            11.16995357
        ];
        $type = [
            'Transport Infrastructure',
            'Wash Infrastructure',
            'Hand Pump Boreholes',
            'Solar Powerd Boreholes',
            'Schools',
            'Classroom Blocks'
        ];
        $category =[
            'Road Network Restored',
            'Bridges Restored',
            'Solar Powered Boreholes',
            'Boreholes',
            'Rehabilitation Of Water Supply System',
            'Rehabilitation Of Water Supply Sources',
            'Vip Laterines'
        ];
        $status = ['initiated','ongoing','completed'];
        $component = ['Component One','Component Two','Component Three'];
        return [
            'slug'=>Str::uuid(),
            'location'=>$this->faker->city,
            'description'=>$this->faker->sentence,
            'community_id'=>Community::all()->random(),
            'number'=>$this->faker->randomNumber(9, false),
            'state_id'=>State::whereIn('id', [2,8,36])->get()->random(),
            'status'=> $status[rand(0, 2)],
            'longtitude'=>$longtitude[rand(0, 3)],
            'latitude'=>$latitude[rand(0, 3)],
            'type'=>$type[rand(0, 5)],
            'category'=>$type[rand(0, 5)],
            'component'=>$component[rand(0, 2)],
            'amount'=>$this->faker->randomNumber(9, false),
            'image'=>'https://app.mcrpbayregistry.org/uploads/520740.95149800 1543058475.JPG',
            'video'=>'https://www.youtube.com/watch?v=nTiPomqrHMc&ab_channel=HouseOnTheRock'
        ];
    }
}
