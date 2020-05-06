<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AssignedRole;
use Faker\Generator as Faker;

$factory->define(AssignedRole::class, function (Faker $faker) {
    return [
        'role_id' => 2,
        'entity_id' => 0,
        'entity_type' => 'person',
    ];
});
