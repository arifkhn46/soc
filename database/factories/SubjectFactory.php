<?php

use Faker\Generator as Faker;

$factory->define(App\Subject::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(200),
    ];
});
