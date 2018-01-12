<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(200),
        'course_type_id' => function () {
            return factory('App\CourseType')->create()->id;
        },
    ];
});
