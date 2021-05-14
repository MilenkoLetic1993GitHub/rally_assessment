<?php

namespace Database\Factories;

use App\Models\NbaGame;
use App\Models\NbaTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class NbaGameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NbaGame::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nbaTeams = NbaTeam::inRandomOrder()->limit(2)->get();

        return [
            'away_team_id' => $nbaTeams->first(),
            'home_team_id' => $nbaTeams->last(),
            'away_team_score' => rand(50, 100),
            'home_team_score' => rand(50, 100)
        ];
    }
}
