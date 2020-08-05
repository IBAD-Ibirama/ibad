<?php

use App\Grupo5\Model\Fotos;
use Illuminate\Database\Seeder;

class FotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Fotos::class, 10)->create()->each(function ($ret) {
            $ret->save();
        });
    }
}
