<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sponsor;
use Faker\Generator as Faker;

$factory->define(Sponsor::class, function (Faker $faker) {
    return [
        'cnpj' => '89.886.000/0001-44',
        'value' => rand(1000, 100000),
        'email' => $faker->unique()->safeEmail,
    ];
});
