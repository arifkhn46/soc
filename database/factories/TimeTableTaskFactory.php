<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\TimeTableTask;
use Faker\Generator as Faker;

$factory->define(TimeTableTask::class, function (Faker $faker) {
    return [
        'day' => 1,
        'start_time' => '06:00 AM',
        'end_time' => '07:00 AM',
        'completed' => false,
    ];
});
