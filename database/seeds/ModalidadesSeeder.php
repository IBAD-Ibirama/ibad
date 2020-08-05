<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->criarRegistros("Simples Masculino", "Masculino");
        $this->criarRegistros("Simples Feminino", "Feminino");
        $this->criarRegistros("Duplas Masculino", "Masculino");
        $this->criarRegistros("Duplas Feminino", "Feminino");
        $this->criarRegistros("Duplas Mistas", "Misto");
    }

    private function criarRegistros($modalidade, $genero)
    {

        DB::table('modalidades')->insert([
            'numero_jogadores' => $modalidade,
            'genero' => $genero,
        ]);
    }
}
