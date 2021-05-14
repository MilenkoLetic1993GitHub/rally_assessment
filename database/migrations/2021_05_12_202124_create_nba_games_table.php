<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNbaGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nba_games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('away_team_id');
            $table->unsignedBigInteger('home_team_id');
            $table->integer('away_team_score');
            $table->integer('home_team_score');
            $table->timestamps();

            $table->foreign('away_team_id')
                ->references('id')
                ->on('nba_teams')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('home_team_id')
                ->references('id')
                ->on('nba_teams')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index(['created_at']);
            $table->index(['updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nba_games');
    }
}
