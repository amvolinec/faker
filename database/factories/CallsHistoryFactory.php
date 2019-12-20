<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CallsHistory;
use Faker\Generator as Faker;

$factory->define(CallsHistory::class, function (Faker $faker) {
    $date = new \DateTime();

    return [
        'realtime_queues_log_callid' => strtolower($faker->word),
        'date_created' => $date,
        'date_updated' => $date,
        'fv_agents_id' => 1,
        'fv_queues_id' => 4,
        'caller_id' => $faker->phoneNumber,
        'called_id' => $faker->phoneNumber,
        'is_answered' => 1,
        'is_missed' => 0,
        'waiting_duration' => $faker->randomNumber(2),
        'call_duration' => $faker->randomNumber(3),
        'direction' => 'in',
        'completed_by' => 'agent',
        'fv_call_theme_id' => 1,
    ];
});
