<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Financeiro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('financeiro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ano');
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
            $table->foreignId('atletas_id');
            $table->foreign('atletas_id')->references('id')->on('atletas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('financeiro');
    }
}
