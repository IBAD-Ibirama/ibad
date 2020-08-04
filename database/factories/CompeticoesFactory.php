<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grupo5\Model\Competicoes;
use Faker\Generator as Faker;

$factory->define(Competicoes::class, function (Faker $faker) {
    return [
         'data' => $faker->dateTime
        ,'local' => $faker->address
        ,'coordenador' => $faker->name
        ,'nivel_competicao' => $faker->randomElement([1, 2, 3]),
    ];
});
