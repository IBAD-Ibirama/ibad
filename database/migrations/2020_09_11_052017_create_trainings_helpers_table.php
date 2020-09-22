<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsHelpersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('trainings_helpers', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('helper_id');
        $table->foreign('helper_id')->references('id')->on('athletes')->onDelete('cascade');
        $table->bigInteger('training_id');
        $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
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
        Schema::dropIfExists('trainings_helpers');
    }
}
