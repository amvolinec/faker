<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agent as Agent;
use App\NewCallback;
use Faker\Generator as Faker;

$factory->define(NewCallback::class, function (Faker $faker) {

//    $queues = Queue::where('is_outbound', 0)->where('id', '>', 0)->pluck('id');
    $agents = Agent::pluck('id');
    $date = new \DateTime();

    return [
        'phone' => $faker->phoneNumber,
        'fv_queues_id' => 16,
//        'fv_queues_id' => $faker->randomElement($queues),
        'first_call_date' => $date,
        'last_call_date' => $date,
        'calls_count' => $faker->randomDigit,
        'delayed_till' => $date,
        'last_delay_comment' => $faker->word,
        'last_delay_date' => $date,
        'last_delay_agent_id' => $faker->randomElement($agents),
    ];
});
