<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Student\Student;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'academic_year_id' => $faker->randomElement(['1', '2']),
        'admission_class_id' => $faker->randomElement([1,2,3,4,5]),
        'reg_number' => Str::random(10),
    ];
});
