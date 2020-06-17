<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Arif Khan',
            'email' => 'arifkhn46@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Jyoti Raman',
            'email' => 'jyoti.raman2013@gmail.com',
            'password' => bcrypt('password'),
        ]);

        factory(\App\User::class, 10)->create();
    }
}
