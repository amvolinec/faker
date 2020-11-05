<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Theme;
use Faker\Generator as Faker;

$factory->define(Theme::class, function (Faker $faker) {
    $name = ucfirst($faker->word() . '_' . $faker->randomNumber(3));
    return [
        'fv_queues_id' => \App\Queue::where([['is_deleted', 0],['is_local', 0], ['is_outbound', 0]])->inRandomOrder()->first(),
        'name' => $name,
    ];
});
