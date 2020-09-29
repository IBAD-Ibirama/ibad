<?php

use Illuminate\Database\Seeder;
use App\Model\Finance;

class FinancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Finance::class, 3)->create()->each(function($ret) {
            $ret->save();
        });
    }
}
