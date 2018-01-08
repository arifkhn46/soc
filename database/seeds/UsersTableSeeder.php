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
            'email' => 'arifkhn46@email.com',
            'password' => bcrypt('India@123'),
        ]);
    }
}
