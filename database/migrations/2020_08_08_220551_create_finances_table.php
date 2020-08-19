<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('finances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->boolean('janeiro');
            $table->boolean('fevereiro');
            $table->boolean('marco');
            $table->boolean('abril');
            $table->boolean('maio');
            $table->boolean('junho');
            $table->boolean('julho');
            $table->boolean('agosto');
            $table->boolean('setembro');
            $table->boolean('outubro');
            $table->boolean('novembro');
            $table->boolean('dezembro');
            $table->foreignId('athletes_id');
            $table->foreign('athletes_id')->references('id')->on('athletes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('finances');
    }
}
