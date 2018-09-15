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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->text(rand(32, 10)),
        'user_name' => $faker->text(rand(32, 10)),
        'email' => $faker->unique()->safeEmail,
        'password' => str_random(60),
        'api_token' => str_random(60)];
});

$factory->define(App\Professional::class, function (Faker\Generator $faker) {
    return [
        'first_name' => str_random(10),
        'last_name' => str_random(10),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'identity' => $faker->text(rand(32, 10))
    ];
});

$factory->define(App\Offer::class, function (Faker\Generator $faker) {
    return [
        'identity' => $faker->text(rand(32, 10))
    ];
});