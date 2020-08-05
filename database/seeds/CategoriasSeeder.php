<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->criarRegistros("Sub 11");
        $this->criarRegistros("Sub 13");
        $this->criarRegistros("Sub 15");

        $this->criarRegistros("Sub 17");
        $this->criarRegistros("Sub 18");
        $this->criarRegistros("Aberto");
       
        $this->criarRegistros("Sênior");
        $this->criarRegistros("Veterano I");
        $this->criarRegistros("Veterano II");
    }

    private function criarRegistros($categoria)
    {

        DB::table('categorias')->insert([
            'categoria' => $categoria,
        ]);
    }
}
