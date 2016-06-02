<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'api_token' => $faker->swiftBicNumber,
    ];
});


$factory->define(App\Models\Ledger::class, function (Faker\Generator $faker) {

    $users_as_obj = DB::table('users')->select('id')->get();

    foreach($users_as_obj as $obj) {
        $users[] = $obj->id;
    }

    $creditor = $faker->randomElement($users);

    if(($key = array_search($creditor, $users)) !== false) {
        unset($users[$key]);
    }

    $debtor = $faker->randomElement($users);

    return [
        'creditor' => $creditor,
        'debtor' => $debtor,
        'credit_type' => $faker->randomElement(['food', 'bowling']),
        'amount' => $faker->randomFloat(2, 1, 8),
    ];
});