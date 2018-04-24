<?php

use Faker\Generator as Faker;

$factory->define(App\Content::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'description' => $faker->text(200),
        'content_repo_id' => function () {
            return factory('App\ContentRepository')->create()->id;
        },
    ];
});
