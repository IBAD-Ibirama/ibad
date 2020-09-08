<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthleteEvaluationBodyIndexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athlete_evaluation_body_index', function (Blueprint $table) {
            $table->id();
            $table->foreignId('athlete_evaluation_id')->constrained()->onDelete('cascade');
            $table->foreignId('body_index_id')->references('id')->on('body_indexes')->constrained();
            $table->double('value');
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
        Schema::dropIfExists('athlete_evaluation_body_index');
    }
}
