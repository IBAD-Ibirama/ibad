<?php

use Illuminate\Database\Seeder;
use App\Grupo5\Model\Financeiro;

class FinanceiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Financeiro::class, 10)->create()->each(function($ret) {
            $ret->save();
        });
    }
}
