<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TeamLevel;
use Faker\Generator as Faker;

$factory->define(TeamLevel::class, function (Faker $faker) {
    $requires_auxiliary =  $faker->boolean(50);
    return [
        'name' => $faker->word(),
        'requires_auxiliary' => $requires_auxiliary,
        'can_be_auxiliary' => !$requires_auxiliary
    ];
});
