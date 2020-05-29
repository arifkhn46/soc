<?php

use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = factory(App\Subject::class, 5)->create();

        foreach ($subjects as $subject) {
            factory(App\Chapter::class)->create(['subject_id' => $subject->id]);
        }
    }
}
