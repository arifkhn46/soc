<?php

use Faker\Generator as Faker;

$factory->define(App\Asset::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'description' => $faker->text(200),
        'type' => 'html',
        'path' => null,
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
    ];
});
