<?php

use Faker\Generator as Faker;

$factory->define(App\ContentRepository::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
    ];
});
