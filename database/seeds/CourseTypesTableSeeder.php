<?php

use App\CourseType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CourseTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$now = Carbon::now()->toDateTimeString();
        $courseTypes = [
        	[
        		'title' => 'Academics',
        		'description' => 'This type of course consists chapters, topics etc.',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'Examination',
        		'description' => 'This type of course consist only practice questions.',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'Academics and Examination',
        		'description' => 'This type of course consists academic and examination content.',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],    
        ];
        CourseType::insert($courseTypes);
    }
}
