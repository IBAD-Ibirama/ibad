<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionParticipationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_participation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('athletes_id');
            $table->foreign('athletes_id')->references('id')->on('athletes')->onDelete('cascade');
            $table->foreignId('modalities_id');
            $table->foreign('modalities_id')->references('id')->on('modalities')->onDelete('cascade');
            $table->foreignId('competitions_id');
            $table->foreign('competitions_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->foreignId('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('results')->nullable();
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
        Schema::dropIfExists('competition_participation');
    }
}
