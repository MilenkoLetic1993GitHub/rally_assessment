<?php

namespace Database\Seeders;

use App\Models\NbaPlayer;
use Illuminate\Database\Seeder;

class NbaPlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NbaPlayer::factory(10)->create();
    }
}
