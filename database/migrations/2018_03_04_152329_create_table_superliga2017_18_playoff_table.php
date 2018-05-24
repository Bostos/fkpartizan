<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSuperliga201718PlayoffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superliga2017_18_playoff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('club')->unique();
            $table->integer('played');
            $table->integer('wins');
            $table->integer('draws');
            $table->integer('defeats');
            $table->integer('goals_for');
            $table->integer('goals_against');
            $table->integer('goal_difference');
            $table->integer('points');
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
        Schema::dropIfExists('table_superliga2017_18_playoff');
    }
}
