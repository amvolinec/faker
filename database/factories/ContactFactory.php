<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;
use Faker\Provider\lt_LT\Company;
use Faker\Provider\lt_LT\PhoneNumber;
use Faker\Provider\lt_LT\Address;
use Faker\Provider\lt_LT\Person;

$factory->define(Contact::class, function (Faker $faker) {

    $faker->addProvider(new Person($faker));
    $faker->addProvider(new Address($faker));
    $faker->addProvider(new PhoneNumber($faker));
    $faker->addProvider(new Company($faker));

    return [
        'phone'=> preg_replace('/\D/', '', $faker->phoneNumber),
        'person' => $faker->name,
        'email' => $faker->freeEmail,
        'address' => $faker->address,
        'comments' => $faker->word,
        'fv_addressbook_company_id' => factory(App\Company::class),
        'created' => date('Y-m-d H:i:s'),
        'updated' => date('Y-m-d H:i:s'),
    ];
});
