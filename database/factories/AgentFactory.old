<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agent;
use App\Group;
use App\Queue;
use Faker\Generator as Faker;

$factory->define(Agent::class, function (Faker $faker) {
//    $groups = Group::pluck('id');
    $queues_out = Queue::where('is_outbound', 1)->where('id', '>', 0)->pluck('id');
    $queues_local = Queue::where('is_local', 1)->where('id', '>', 0)->pluck('id');
    $date = new \DateTime();

    return [
        'groups_id' => 11,
        'date_created' => $date,
        'date_updated' => $date,
        'username' => $faker->unique()->numberBetween(4000, 6000),
        'password' => '824824',
        'name' => $faker->unique()->name(),
        'email' => 'agent@gmail.com',
        'context' => 'agent',
        'fv_queues_id_outbound' => $faker->randomElement($queues_out),
        'fv_queues_id_local' => $faker->randomElement($queues_local),
        'is_password_required' => 0,
        'is_active' => 1,
        'is_deleted' => 0,
        'listen_status' => 1,
        'tigra_id' => '',
    ];
});
