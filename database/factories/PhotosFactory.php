<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'path_photo' => $faker->imageUrl(),
        'competitions_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
    ];
});
