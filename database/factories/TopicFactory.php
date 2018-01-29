<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'body' => $faker->text(200),
        'subject_id' => function () {
            return factory('App\Subject')->create()->id;
        },
        'user_id' => function () {
            return factory('App\User')->create()->id;
        }
    ];
});
