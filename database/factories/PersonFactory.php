<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {

    $salt = $faker->text(8);
    $password = hash('sha256', '824824' . $salt);

    return [
        'username' => getUniqUsername($faker),
        'password' => $password,
        'salt' => $salt,
        'name' => $faker->firstName,
        'email' => $faker->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'company' => $faker->company,
        'comment' => $faker->paragraph(3),
        'date_pass_changed' => date('Y-m-d H:i:s'),
        'date_created' => date('Y-m-d H:i:s'),
        'date_updated' => date('Y-m-d H:i:s'),
        'changed_by_username' => 'faker'
    ];
});

$factory->afterCreating(App\Person::class, function ($person, $faker) {
    $person->permission()->save(factory(App\PersonPermission::class)->make());
    $person->roles()->save(factory(App\AssignedRole::class)->make());
    $person->agent()->save(factory(App\Agent::class)->make());
});

function getUniqUsername($faker) {
    $original = false;
    do {
        $username = $faker->unique()->numberBetween(1000, 9999);
        if (!Person::where('username', $username)->exists()) {
            $original = true;
        }
    } while (!$original);
    return $username;
}