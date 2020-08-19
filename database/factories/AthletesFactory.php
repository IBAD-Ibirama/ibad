<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Athletes;
use Faker\Generator as Faker;

$factory->define(Athletes::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
