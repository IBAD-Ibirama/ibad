<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grupo5\Model\Fotos;
use Faker\Generator as Faker;

$factory->define(Fotos::class, function (Faker $faker) {
    return [
        'path_foto' => $faker->imageUrl(),
        'competicoes_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
    ];
});
