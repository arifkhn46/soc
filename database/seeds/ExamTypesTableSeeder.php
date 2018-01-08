<?php

use App\ExamType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ExamTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $examTypes = $this->getExamTypes();
        ExamType::insert($examTypes);
    }

    /**
     * Get exam types.
     *
     * @return array
     */
    public function getExamTypes()
    {
    	$now = Carbon::now()->toDateTimeString();
    	return array(
        	[
        		'title' => 'Bank PO',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'Bank SO',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'Bank Clerk',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'SSC',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'Delhi Police',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'Railways',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'Insurance',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'RBI',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'GK and Current Affairs',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'BSNL TTA',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
			[
        		'title' => 'Gate CS',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'SSC JE CE',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'SSC JE EE',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'Aptitude',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'ECIL',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'PSPCL',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        	[
        		'title' => 'PNRD Assam',
        		'description' => '',
        		'user_id' => 1,
        		'created_at'=> $now,
         		'updated_at'=> $now,
        	],
        );
    }
}
