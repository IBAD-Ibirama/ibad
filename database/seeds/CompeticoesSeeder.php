<?php

use Illuminate\Database\Seeder;
use App\Grupo5\Model\Competicoes;

class CompeticoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Competicoes::class, 10)->create()->each(function($ret) {
            $ret->save();
        });
    }
}
