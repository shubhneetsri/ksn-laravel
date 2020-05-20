<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_type' => '1',
        'email' => $faker->unique()->safeEmail,
        'gender' => $faker->randomElement(['M', 'F']),//the gender does not match the name as it is.
        'phonenumber' => mt_rand(91111111111, 99999999999),
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'address' => $faker->address,
        'state_id' => 1,
        'city_id' => 1,
        'date_of_join' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
