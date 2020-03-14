<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert user data into user table
        DB::table('user')->insert([
            'email' => 'nicolas@gmail.com',
            'age' => 18,
            'profile_id' => 1,
        ]);
        
        DB::table('user')->insert([
            'email' => 'naweed@gmail.com',
            'age' => 19,
            'profile_id' => 2,
        ]);
        
        DB::table('user')->insert([
            'email' => 'afrah@gmail.com',
            'age' => 20,
            'profile_id' => 3,
        ]);
           
    }
}
