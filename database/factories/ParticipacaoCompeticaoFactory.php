<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grupo5\Model\ParticipacaoCompeticao;
use Faker\Generator as Faker;

$factory->define(ParticipacaoCompeticao::class, function (Faker $faker) {
    return [
        'atleta_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        'modalidade_id' => $faker->randomElement([1, 2, 3, 4, 5]),
        'competicao_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        'categoria_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
        'resultado' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
    ];
});
