<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Queue;
use Faker\Generator as Faker;

$factory->define(Queue::class, function (Faker $faker) {
    $name = strtoupper($faker->word() . '_' . $faker->randomNumber(3));
    return [
        'name' => $name,
        'alias' => $name,
        'timeout' => $faker->numberBetween(100, 9999),
        'wrapuptime' => $faker->randomNumber(3),
        'weight' => 0,
        'sla' => $faker->numberBetween(20, 60),
    ];
});
