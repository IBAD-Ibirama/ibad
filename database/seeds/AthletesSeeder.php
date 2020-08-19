<?php

use Illuminate\Database\Seeder;
use App\Model\Athletes;

class AthletesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Athletes::class, 10)->create()->each(function ($ret) {
            $ret->save();
        });
    }
}
