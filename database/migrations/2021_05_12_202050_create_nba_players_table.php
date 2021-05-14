<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNbaPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nba_players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->integer('wins');
            $table->integer('losses');
            $table->unsignedBigInteger('nba_team_id');
            $table->timestamps();

            $table->foreign('nba_team_id')
                ->references('id')
                ->on('nba_teams')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index(['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nba_players');
    }
}
