<?php

namespace Database\Seeders;

use App\Models\NbaGame;
use Illuminate\Database\Seeder;

class NbaGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NbaGame::factory(10)->create();
    }
}
