<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Competitions;
use Faker\Generator as Faker;

$factory->define(Competitions::class, function (Faker $faker) {
    return [
         'date' => $faker->dateTime
        ,'place' => $faker->address
        ,'coordinator' => $faker->name
        ,'competition_level' => $faker->randomElement([1, 2, 3]),
    ];
});
