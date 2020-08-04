<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipacaoCompeticaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participacao_competicao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atletas_id');
            $table->foreign('atletas_id')->references('id')->on('atletas');
            $table->foreignId('modalidades_id');
            $table->foreign('modalidades_id')->references('id')->on('modalidades');
            $table->foreignId('competicoes_id');
            $table->foreign('competicoes_id')->references('id')->on('competicoes');
            $table->foreignId('categorias_id');
            $table->foreign('categorias_id')->references('id')->on('categorias');
            $table->string('resultado')->nullable();
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
        Schema::dropIfExists('participacao_competicao');
    }
}
