<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $courses = [
       		[ 'title' => 'B.Tech CSE', 'course_type_id' => 1, 'user_id' => 1],
       		[ 'title' => 'SSCGL', 'course_type_id' => 2, 'user_id' => 1],
       		[ 'title' => 'B.Tech CSE + Examination', 'course_type_id' => 3, 'user_id' => 1], 
       ]; 
       foreach ($courses as $course) {
       	 $fakerCourse = factory(App\Course::class)->create($course);
       }
    }
}
