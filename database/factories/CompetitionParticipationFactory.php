<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\CompetitionParticipation;
use Faker\Generator as Faker;

$factory->define(CompetitionParticipation::class, function (Faker $faker) {
    return [
        'athletes_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        'modalities_id' => $faker->randomElement([1, 2, 3, 4, 5]),
        'competitions_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        'categories_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
        'results' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
    ];
});
