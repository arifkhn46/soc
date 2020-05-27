<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;
use App\Subject;
use App\Enum\TaskState;

$factory->define(Task::class, function (Faker $faker) {
    $startingDate = new Carbon\Carbon();
    $subject = factory(Subject::class)->create();
    
    return [
        'title' => $faker->text(10),
        'description' => $faker->text(200),
        'type' => 1,
        'state' => '',
        'start_at' => $startingDate->format('Y-m-d H:m:s'),
        'end_at' => $startingDate->addHours(1)->format('Y-m-d H:m:s'),
        'subject_id' => $subject,
        'chapter_id' => factory(App\Chapter::class)->create(['subject_id' => $subject->id]),
        'owner_id' => factory(App\User::class),
        'assignee_id' => '',
    ];
});


$factory->state(Task::class, 'created', [
    'state' => TaskState::created(),
]);