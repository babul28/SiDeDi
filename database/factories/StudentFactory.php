<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'NISN' => $faker->randomNumber(9),
        'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
        'religion' => $faker->randomElement(['islam', 'kristen', 'katholik', 'hindu', 'buddha', 'konghuchu']),
        'age' => $faker->numberBetween(15, 25),
        'class_id' => $faker->numberBetween(1, 10),
    ];
});
