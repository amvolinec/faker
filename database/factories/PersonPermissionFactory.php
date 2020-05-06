<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonPermission;
use Faker\Generator as Faker;

$factory->define(PersonPermission::class, function (Faker $faker) {
    return [
        'person_id' => 0,
        'status_see' => 4,
        'status_listen' => 4,
        'status_eval' => 4,
        'monitoring_style' => 0,
    ];
});
