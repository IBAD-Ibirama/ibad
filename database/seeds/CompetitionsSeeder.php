<?php

use Illuminate\Database\Seeder;
use App\Model\Competitions;

class CompetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Competitions::class, 10)->create()->each(function($ret) {
            $ret->save();
        });
    }
}
