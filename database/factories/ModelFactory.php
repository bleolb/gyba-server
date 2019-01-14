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

// User
use Illuminate\Support\Facades\Hash;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'first_name' => $faker->text(rand(32, 10)),
        'last_name' => $faker->text(rand(32, 10)),
        'phone' => $faker->text(rand(32, 10)),
        'address' => $faker->text(rand(32, 10)),
        'role' => $faker->text(rand(32, 10)),
        'email' => $faker->unique()->safeEmail,
        'password' =>Hash::make('123456'),
        'api_token' => str_random(60)];
});

// Role
$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->text(rand(32, 10)),
        'role' => '1',
        'state' => 'ACTIVE',
    ];
});

// Professional
$factory->define(App\Professional::class, function (Faker\Generator $faker) {
    return [
        'identity' => str_random(10),
        'first_name' => str_random(10),
        'last_name' => str_random(10),
        'email' => $faker->unique()->safeEmail,
        'nationality' => str_random(10),
        'civil_state' => str_random(10),
        'birthdate' => '2018-10-01',
        'gender' => str_random(10),
        'phone' => str_random(10),
        'address' => str_random(10),
        'state' => str_random(10),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
// Company
$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'identity' => $faker->text(rand(32, 10)),
        'nature' => $faker->text(rand(32, 10)),
        'trade_name' => $faker->text(rand(32, 10)),
        'email' => $faker->unique()->safeEmail,
        'comercial_activity' => $faker->text(rand(32, 10)),
        'phone' => $faker->text(rand(32, 10)),
        'cell_phone' => $faker->text(rand(32, 10)),
        'address' => $faker->text(rand(32, 10)),
        'state' => 'ACTIVE',
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

// Offer
$factory->define(App\Offer::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->text(rand(32, 10)),
        'contact' => $faker->text(rand(32, 10)),
        'email' => $faker->text(rand(32, 10)),
        'phone' => $faker->text(rand(32, 10)),
        'cell_phone' => $faker->text(rand(32, 10)),
        'contract_type' => $faker->text(rand(32, 10)),
        'position' => $faker->text(rand(32, 10)),
        'broad_field' => 'EDUCACIÓN',
        'specific_field' => 'ASISTENTE PEDAGÓGICO CON NIVEL EQUIVALENTE A TECNÓLOGO SUPERIOR',
        'training_hours' => $faker->text(rand(32, 10)),
        'remuneration' => $faker->text(rand(32, 10)),
        'working_day' => $faker->text(rand(32, 10)),
        'number_jobs' => $faker->text(rand(32, 10)),
        'experience_time' => $faker->text(rand(32, 10)),
        'activities' => $faker->text(rand(400, 300)),
        'start_date' => $faker->dateTimeThisMonth()->format('Y-m-d'),
        'finish_date' => $faker->dateTimeThisMonth()->format('Y-m-d'),
        'aditional_information' => $faker->text(rand(400, 300)),
        'province' => $faker->text(rand(32, 10)),
        'city' => $faker->text(rand(32, 10)),
        'state' => 'ACTIVE',
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