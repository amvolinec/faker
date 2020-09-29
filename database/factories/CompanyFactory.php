<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    $code = $faker->randomNumber(8);
    return [
        'name' => $faker->company . ' & '. $faker->firstName .  ' # ' . $faker->randomNumber(6),
        'address' => $faker->unique()->address,
        'code' => $code,
        'vat_code' => 'LT' . $code,
        'email' => $faker->companyEmail,
        'created' => date('Y-m-d H:i:s'),
        'updated' => date('Y-m-d H:i:s'),
    ];
});
