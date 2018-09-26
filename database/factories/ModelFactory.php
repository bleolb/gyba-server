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
        'user_name' => $faker->unique()->safeEmail,
        'email' => $faker->unique()->safeEmail,
        'password' => '123456',
        'api_token' => str_random(60)];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {

    return [

        'description' => $faker->text(rand(32, 10)),
        'role' => 1
    ];
});

$factory->define(App\Professional::class, function (Faker\Generator $faker) {
    return [
        'first_name' => str_random(10),
        'last_name' => str_random(10),
        'email' => $faker->unique()->safeEmail,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'identity' => $faker->text(rand(32, 10)),
        'nature' => $faker->text(rand(32, 10)),
        'email' => $faker->unique()->safeEmail,
        'cell_phone' => $faker->text(rand(32, 10)),
        'phone' => $faker->text(rand(32, 10)),
        'trade_name' => $faker->text(rand(32, 10)),
        'comercial_activity' => $faker->text(rand(32, 10)),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(App\Offer::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->text(rand(32, 10)),
        'position' => $faker->text(rand(32, 10)),
        'city' => $faker->text(rand(32, 10)),
        'province' => $faker->text(rand(32, 10)),
        'broad_field' => $faker->text(rand(32, 10)),
        'specific_field' => $faker->text(rand(32, 10)),
        'remuneration' => $faker->text(rand(32, 10)),
        'working_day' => $faker->text(rand(32, 10)),
        'activities' => $faker->text(rand(400, 300)),
        'start_date' => $faker->dateTimeThisMonth()->format('Y-m-d'),
        'finish_date' => $faker->dateTimeThisMonth()->format('Y-m-d'),
        'company_id' => function () {
            return factory(App\Company::class)->create()->id;
        }
    ];
});

$factory->define(App\AcademicFormation::class, function (Faker\Generator $faker) {
    return [
        'institution' => $faker->text(rand(32, 10)),
        'career' => $faker->text(rand(32, 10)),
        'professional_degree' => $faker->text(rand(32, 10)),
        'registration_date' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'senescyt_code' => $faker->text(rand(32, 10)),
        'professional_id' => function () {
            return factory(App\Professional::class)->create()->id;
        }
    ];
});

$factory->define(App\Ability::class, function (Faker\Generator $faker) {
    return [
        'category' => $faker->text(rand(32, 10)),
        'description' => $faker->text(rand(32, 10)),
        'professional_id' => function () {
            return factory(App\Professional::class)->create()->id;
        }
    ];
});

$factory->define(App\Language::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->text(rand(32, 10)),
        'written_level' => $faker->text(rand(32, 10)),
        'spoken_level' => $faker->text(rand(32, 10)),
        'reading_level' => $faker->text(rand(32, 10)),
        'professional_id' => function () {
            return factory(App\Professional::class)->create()->id;
        }
    ];
});

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [
        'event_type' => $faker->text(rand(32, 10)),
        'institution' => $faker->text(rand(32, 10)),
        'event_name' => $faker->text(rand(32, 10)),
        'start_date' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'finish_date' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'hours' => $faker->text(rand(32, 10)),
        'type_certification' => $faker->text(rand(32, 10)),
        'professional_id' => function () {
            return factory(App\Professional::class)->create()->id;
        }
    ];
});

$factory->define(App\ProfessionalReference::class, function (Faker\Generator $faker) {
    return [
        'institution' => $faker->text(rand(32, 10)),
        'position' => $faker->text(rand(32, 10)),
        'contact' => $faker->text(rand(32, 10)),
        'phone' => $faker->text(rand(32, 10)),
        'professional_id' => function () {
            return factory(App\Professional::class)->create()->id;
        }
    ];
});

$factory->define(App\ProfessionalExperience::class, function (Faker\Generator $faker) {
    return [
        'employer' => $faker->text(rand(32, 10)),
        'position' => $faker->text(rand(32, 10)),
        'job_description' => $faker->text(rand(32, 10)),
        'start_date' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'finish_date' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'reason_leave' => $faker->text(rand(32, 10)),
        'professional_id' => function () {
            return factory(App\Professional::class)->create()->id;
        }
    ];
});