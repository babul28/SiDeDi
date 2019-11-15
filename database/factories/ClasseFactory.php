<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Classe;
use Faker\Generator as Faker;

$factory->define(Classe::class, function (Faker $faker) {
    $user = factory(App\User::class)->create();
    $user->TeacherBiodata()->create(factory(App\TeacherBiodata::class)->make()->toArray());

    return [
        'name_class' => $faker->word,
        'path_img_header' => $faker->imageUrl($width = 640, $height = 480),
        'code_ref_class' => Str::random(10),
        'user_id' => $user->id,
    ];
});
