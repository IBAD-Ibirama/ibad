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
            $table->foreignId('atleta_id');
            $table->foreign('atleta_id')->references('id')->on('atletas');
            $table->foreignId('modalidade_id');
            $table->foreign('modalidade_id')->references('id')->on('modalidades');
            $table->foreignId('competicao_id');
            $table->foreign('competicao_id')->references('id')->on('competicoes');
            $table->foreignId('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
