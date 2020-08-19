<?php

use Illuminate\Database\Seeder;
use App\Model\Finances;

class FinancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Finances::class, 3)->create()->each(function($ret) {
            $ret->save();
        });
    }
}
