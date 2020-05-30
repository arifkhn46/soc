<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
    ];
});
