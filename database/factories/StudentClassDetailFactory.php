<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Student\StudentClassDetail;

$factory->define(StudentClassDetail::class, function (Faker $faker) {

    $user = factory(App\Models\Student\Student::class)->create();

    return [
        'student_id' => $user->id,
        'class_id' => $user->admission_class_id,
        'academic_year_id' => $faker->randomElement(['1', '2']),
        'status' => '1',
    ];
});
