<?php

use Faker\Generator as Faker;

$factory->define(App\ExamType::class, function (Faker $faker) use ($factory) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(200),
        'status' => 1,
        'user_id' => $factory->create(App\User::class)->id,
    ];
});
