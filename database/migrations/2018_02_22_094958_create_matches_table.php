<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('home_team');
            $table->string('away_team');
            $table->integer('home_goals')->nullable();
            $table->integer('away_goals')->nullable();
            $table->string('home_scorers')->nullable();
            $table->string('away_scorers')->nullable();
            $table->integer('competition_id');
            $table->string('place');
            $table->date('date');
            $table->integer('season_id');
            $table->string('highlights')->nullable();
            $table->string('home_logo');
            $table->string('away_logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
