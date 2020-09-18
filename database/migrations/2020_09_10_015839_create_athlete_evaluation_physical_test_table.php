<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthleteEvaluationPhysicalTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athlete_evaluation_physical_test', function (Blueprint $table) {
            $table->id();
            $table->foreignId('athlete_evaluation_id')->constrained()->onDelete('cascade');
            $table->foreignId('physical_test_id')->constrained();
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
        Schema::dropIfExists('athlete_evaluation_physical_test');
    }
}
