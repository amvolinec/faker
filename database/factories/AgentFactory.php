<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agent;
use Faker\Generator as Faker;

$factory->define(Agent::class, function (Faker $faker) {
    return [
        'person_id' => 0,
        'username' => $faker->unique()->numberBetween(4000, 6000),
        'password' => '824824',
        'context' => 'agents',
        'is_password_required' => 0,
        'is_deleted' => 0,
        'listen_status' => 1,
        'date_created' => date('Y-m-d H:i:s'),
        'date_updated' => date('Y-m-d H:i:s'),
    ];
});

