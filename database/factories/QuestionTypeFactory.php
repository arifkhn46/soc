<?php

use Faker\Generator as Faker;

$factory->define(App\QuestionType::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'user_id' => function() {
            return factory('App\User')->create()->id;
        }
    ];
});
