<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovesTable extends Migration
{

    public function up()
    {
        Schema::create('moves', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->date("date");
            $table->string("value");
            $table->string("type");
            $table->string("specification");
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('moves');
    }
}
