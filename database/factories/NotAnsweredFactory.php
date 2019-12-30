<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CallsHistory;
use Faker\Generator as Faker;

$factory->define(CallsHistory::class, function (Faker $faker) {
    $date = new \DateTime();
    $call_id = (string)time();
    $called_id = '846136935';

    return [
        'realtime_queues_log_callid' => $call_id . '.' . $faker->randomNumber(3),
        'date_created' => $date,
        'date_updated' => $date,
        'fv_agents_id' => 51,
        'fv_queues_id' => 16,
        'caller_id' => '4001',
        'called_id' => $called_id,
        'is_answered' => 0,
        'is_missed' => 0,
        'waiting_duration' => 0,
        'call_duration' => 0,
        'direction' => 'out',
        'completed_by' => 'n/a',
    ];
});
