<?php

use Faker\Generator as Faker;

$factory->define(App\CourseType::class, function (Faker $faker) use ($factory) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(200),
        'user_id' => $factory->create(App\User::class)->id,
    ];
});
