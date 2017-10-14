<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory('App\User')->create([
            'name' => 'admin',
            'email' => 'arifkhn46@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $role = factory('App\Role')->create([
            'name' => 'admin',
        ]); 

        $user->attachRole($role->id);
    }
}
