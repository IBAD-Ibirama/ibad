<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Competition;
use Faker\Generator as Faker;

$factory->define(Competition::class, function (Faker $faker) {
    return [
         'date' => $faker->dateTime
        ,'place' => $faker->address
        ,'description' => $faker->paragraph
        ,'competition_level' => $faker->randomElement([1, 2, 3]),
    ];
});
