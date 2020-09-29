<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsibleAthleteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athlete_responsible', function (Blueprint $table) {
            $table->unsignedBigInteger('responsible_id')->nullable();
            $table->unsignedBigInteger('athlete_id')->nullable();
            $table->timestamps();

            $table->primary(['responsible_id','athlete_id']);
            $table->foreign('responsible_id')
            ->references('id')->on('responsibles')
            ->onDelete('cascade');
            $table->foreign('athlete_id')
            ->references('id')->on('athletes')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responsible_athlete');
    }
}
