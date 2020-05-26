<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Chapter;
use Faker\Generator as Faker;

$factory->define(Chapter::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'subject_id' => factory('App\Subject'),
    ];
});
