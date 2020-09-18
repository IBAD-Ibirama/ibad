<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Athlete;
use Faker\Generator as Faker;

$factory->define(Athlete::class, function (Faker $faker) {
    $date = $faker->dateTimeBetween('+3 days', '+15 days');
    return [
        'created_at' => $date,
        'created_at' => $date
    ];
});
