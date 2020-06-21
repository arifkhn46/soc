<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\TimeTable;
use Faker\Generator as Faker;

$factory->define(TimeTable::class, function (Faker $faker) {

    $date = \Carbon\Carbon::now();

    return [
        'start_date' => $date->format('Y-m-d'),
        'end_date' => $date->addDays(15)->format('Y-m-d'),
        'owner_id' => factory(App\User::class),
    ];
});
