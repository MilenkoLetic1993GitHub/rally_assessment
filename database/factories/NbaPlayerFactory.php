<?php

namespace Database\Factories;

use App\Models\NbaPlayer;
use App\Models\NbaTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class NbaPlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NbaPlayer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name('male'),
            'age' => rand(20, 40),
            'wins' => rand(50, 100),
            'losses' => rand(50, 100),
            'nba_team_id' => NbaTeam::inRandomOrder()->first()
        ];
    }
}
