<?php

use Faker\Generator as Faker;

$factory->define(App\SubjectCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(200),
        'user_id' => function() {
            return factory('App\User')->create()->id;
        }
    ];
});
