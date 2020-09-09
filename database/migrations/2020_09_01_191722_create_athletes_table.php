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
            $table->date('dataNasc');
            $table->char('sexo',1);
            $table->string('rg');
            $table->string('fone');
            $table->char('periodo',1);
            $table->string('serie');
            $table->string('problemaSaude');
            $table->string('medicacao');
            $table->char('tamanhoUniforme',2); //Não sei muito sobre roupa, mas acredito que vá até GG
            $table->char('tipoSangue',5); //Apenas segui conforme a diagramação
            $table->string('escola');
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
