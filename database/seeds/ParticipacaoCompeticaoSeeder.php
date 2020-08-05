<?php

use Illuminate\Database\Seeder;
use App\Grupo5\Model\ParticipacaoCompeticao;

class ParticipacaoCompeticaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ParticipacaoCompeticao::class, 10)->create()->each(function ($ret) {
            $ret->save();
        });
    }
}
