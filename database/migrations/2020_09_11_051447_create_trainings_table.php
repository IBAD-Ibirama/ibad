<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('trainings', function (Blueprint $table) {
        $table->id();
        $table->timestamp('date');
        $table->string('time_init');
        $table->string('time_end');
        $table->string('week_day');

        
        $table->bigInteger('trainer_id');
        $table->foreign('trainer_id')->references('id')->on('users');

        $table->bigInteger('team_id');
        $table->foreign('team_id')->references('id')->on('teams');

        $table->bigInteger('local_id');
        $table->foreign('local_id')->references('id')->on('locals');

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
        Schema::dropIfExists('trainings');
    }
}
