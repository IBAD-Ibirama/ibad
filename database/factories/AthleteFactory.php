<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Athlete;
use Faker\Generator as Faker;

$factory->define(Athlete::class, function (Faker $faker) {
    return [
        'birthdate' => $faker->date(),
        'gender' => 'm',
        'rg' => $faker->randomNumber($nbDigits = 9, $strict = false),
        'telephone' => $faker->creditCardNumber,
        'shift' => 'm',
        'grade' => $faker->word,
        'health_problem' => $faker->word,
        'medication' => $faker->word,
        'cloth_size' => 'mm',
        'blood_type' => 'o+pmm',
        'school' => $faker->word,
    ];
});
