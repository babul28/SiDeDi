<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TeacherBiodata;
use Faker\Generator as Faker;

$factory->define(TeacherBiodata::class, function (Faker $faker) {
    return [
        'NIP' => $faker->randomNumber(9),
        'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
        'religion' => $faker->randomElement(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu']),
        'institution' => $faker->randomElement(['SMA 1 Malang', 'SMA 2 Malang', 'SMA 3 Malang', 'SMA 4 Malang', 'SMA 5 Malang', 'SMA 6 Malang', 'SMA 7 Malang'])
    ];
});
