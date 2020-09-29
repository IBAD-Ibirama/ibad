<?php

use Illuminate\Database\Seeder;
use App\Model\Competition;

class CompetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Competition::class, 10)->create()->each(function($ret) {
            $ret->save();
        });
    }
}
