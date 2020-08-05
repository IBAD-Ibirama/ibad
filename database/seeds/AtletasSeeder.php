<?php

use Illuminate\Database\Seeder;
use App\Grupo5\Model\Atletas;

class AtletasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Atletas::class, 10)->create()->each(function ($ret) {
            $ret->save();
        });
    }
}
