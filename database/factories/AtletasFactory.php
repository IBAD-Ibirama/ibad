<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grupo5\Model\Atletas;
use Faker\Generator as Faker;

$factory->define(Atletas::class, function (Faker $faker) {
    return [
        'nome' => $faker->name
    ];
});
