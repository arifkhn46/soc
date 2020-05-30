<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
         	UsersTableSeeder::class,
        	CourseTypesTableSeeder::class,
            CoursesTableSeeder::class,
            ChapterSeeder::class,
            TaskSeeder::class,
            PermissionSeeder::class,
	    ]);
    }
}
