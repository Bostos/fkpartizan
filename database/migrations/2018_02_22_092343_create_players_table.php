<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('country', 30);
            $table->string('position');
            $table->date('birth_date');
            $table->integer('apps');
            $table->integer('goals');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('avatar_id')->default(1);
            $table->integer('cover_id')->default(2);
            $table->string('debut');
            $table->string('previous_club');
            $table->date('date_of_signing');
            $table->date('date_of_leaving')->nullable();
            $table->string('status');
            $table->integer('number');
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
        Schema::dropIfExists('players');
    }
}
