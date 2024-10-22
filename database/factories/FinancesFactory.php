<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Finance;
use Faker\Generator as Faker;

$factory->define(Finance::class, function (Faker $faker) {
    return [
        'year'        => $faker->randomElement([2017, 2018, 2019, 2020]),
        'janeiro'     => $faker->randomElement([0, 1]),
        'fevereiro'   => $faker->randomElement([0, 1]),
        'marco'       => $faker->randomElement([0, 1]),
        'abril'       => $faker->randomElement([0, 1]),
        'maio'        => $faker->randomElement([0, 1]),
        'junho'       => $faker->randomElement([0, 1]),
        'julho'       => $faker->randomElement([0, 1]),
        'agosto'      => $faker->randomElement([0, 1]),
        'setembro'    => $faker->randomElement([0, 1]),
        'outubro'     => $faker->randomElement([0, 1]),
        'novembro'    => $faker->randomElement([0, 1]),
        'dezembro'    => $faker->randomElement([0, 1]),
        'athletes_id' => $faker->randomElement([1])
    ];
});
