<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->date('birthdate');
            $table->char('gender', 1);
            $table->string('rg');
            $table->string('telephone');
            $table->char('shift', 1);
            $table->string('grade');
            $table->string('health_problem');
            $table->string('medication');
            $table->char('cloth_size', 2);
            $table->char('blood_type', 5);
            $table->string('school');
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
        Schema::dropIfExists('athletes');
    }
}
