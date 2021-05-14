<?php

namespace Database\Factories;

use App\Models\NbaTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class NbaTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NbaTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetName,
            'wins' => rand(50, 100),
            'losses' => rand(50, 100)
        ];
    }
}
