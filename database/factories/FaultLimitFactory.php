<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FaultLimit;
use Faker\Generator as Faker;

$factory->define(FaultLimit::class, function (Faker $faker) {
  return [
      'limit' => $faker->numberBetween(1,5)
  ];
});
