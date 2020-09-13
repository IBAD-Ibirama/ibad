<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Athlete;
use Faker\Generator as Faker;

$factory->define(Athlete::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
