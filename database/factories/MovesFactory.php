<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Moves;
use Faker\Generator as Faker;

$factory->define(Moves::class, function (Faker $faker) {
    return [
        'description' => $faker -> sentence($nbWords = 6, $variableNbWords = true),
        'date' => $faker -> date($format = 'Y-m-d', $max = 'now'),
        'value' => $faker -> randomFloat($nbMaxDecimals = 2, $min = 1, $max = 10000),
        'type' => $faker-> word,
        'specification' => $faker -> word
    ];
        
});
