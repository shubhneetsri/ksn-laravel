<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Student\Student;
use App\Helpers\Helper;

$factory->define(Student::class, function (Faker $faker) {

    $user = factory(App\User::class)->create();

    return [
        'user_id' => $user->id, 
        'father_name' => $faker->name,
        'mother_name' => $faker->name,
        'caste' => $faker->randomElement(['GEN','SC','ST','OBC']),
        'current_address' => $faker->address,
        'academic_year_id' => $faker->randomElement(['1', '2']),
        'admission_class_id' => $faker->randomElement([1,2,3,4,5]),
        'reg_number' => Helper::getRegistrationCode($user->id),
    ];
});

/**
 * function () { return factory(App\User::class)->create()->id; },
 */
