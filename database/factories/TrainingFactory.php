<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Training;
use Faker\Generator as Faker;

$factory->define(Training::class, function (Faker $faker) {
    return [
      'date' => $faker->dateTimeBetween('+3 days', '+15 days')
    ];
});
