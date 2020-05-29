<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Task::class, 10)
            ->states('created')
            ->create(['subject_id' => null, 'chapter_id' => null, 'assignee_id' => 1, 'owner_id' => 1]);
    }
}
