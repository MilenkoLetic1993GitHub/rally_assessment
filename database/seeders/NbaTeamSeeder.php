<?php

namespace Database\Seeders;

use App\Models\NbaTeam;
use Illuminate\Database\Seeder;

class NbaTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NbaTeam::factory(10)->create();
    }
}
