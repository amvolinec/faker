<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;
use Faker\Provider\lt_LT\Company;
use Faker\Provider\lt_LT\PhoneNumber;
use Faker\Provider\lt_LT\Address;
use Faker\Provider\lt_LT\Person;
use Faker\Provider\Lorem;

$factory->define(Contact::class, function (Faker $faker) {

    $faker->addProvider(new Person($faker));
    $faker->addProvider(new Address($faker));
    $faker->addProvider(new PhoneNumber($faker));
    $faker->addProvider(new Company($faker));
    $faker->addProvider(new Lorem($faker));

    return [
        'phone' => getUniqPhone($faker),
        'person' => $faker->name,
        'email' => $faker->freeEmail,
        'address' => $faker->address,
        'comments' => $faker->sentence,
        'fv_addressbook_company_id' => factory(App\Company::class),
        'created' => date('Y-m-d H:i:s'),
        'updated' => date('Y-m-d H:i:s'),
    ];
});

function getUniqPhone($faker)
{
    $original = false;
    do {
        $phone = getPhone();
//        $phone = preg_replace('/\D/', '', $faker->phoneNumber);

        if (!Contact::where('phone', $phone)->exists()) {
            $original = true;
        }
    } while (!$original);
    return $phone;
}

function getPhone() {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 7; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return '3706' . $randomString;
}
