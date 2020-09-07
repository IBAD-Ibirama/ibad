<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createMove('Recebimento de patrocinador', '2020-08-27', '100,00', 'entrada', 'Recebimento de verba de empresa');
        $this->createMove('Recebimento de mensalidade', '2020-08-27', '50,00', 'entrada', 'Recebimento de mensalidade de aluno');
        $this->createMove('Pagamento de novas raquetes', '2020-08-27', '450,00', 'saida', 'Para a empresa Racky S.A');
    }

    private function createMove($description, $date, $value, $type, $specification)
    {
        DB::table('moves')->insert([
            'description' => $description,
            'date' => $date,
            'value' => $value,
            'type' => $type,
            'specification' => $specification,
        ]);
    }
}
