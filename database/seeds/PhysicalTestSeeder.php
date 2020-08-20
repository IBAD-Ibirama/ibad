<?php

use Illuminate\Database\Seeder;

class PhysicalTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('physical_tests')->insert([
            [
                'name' => 'Arremesso medicineball 2kg (cm)'
            ],
            [
                'name' => 'Salto horizontal (cm)'
            ],
            [
                'name' => 'Teste do quadrado 4m (s)'
            ],
            [
                'name' => 'Corrida de 20m (s)'
            ],
            [
                'name' => 'Teste do bipe'
            ],
            [
                'name' => 'Teste de sentar e alcançar (cm)'
            ],
            [
                'name' => 'Nº de abdominais em 1 min'
            ]
        ]);
    }
}
