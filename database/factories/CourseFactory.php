<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(200),
        'exam_type_id' => function () {
            return factory('App\ExamType')->create()->id;
        },
    ];
});
