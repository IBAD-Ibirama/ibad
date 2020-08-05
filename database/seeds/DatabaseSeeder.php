<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ModalidadesSeeder::class);
        $this->call(CompeticoesSeeder::class);
        $this->call(AtletasSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(FotosSeeder::class);
        $this->call(ParticipacaoCompeticaoSeeder::class);

        Model::reguard();
    }
}
