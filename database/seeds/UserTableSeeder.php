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
            'name' => 'Nicolas', 
            'email' => 'nicolas@gmail.com',
            'age' => 18,
        ]);
        
        DB::table('user')->insert([
            'name' => 'Naweed',
            'email' => 'naweed@gmail.com',
            'age' => 19,
        ]);
        
        DB::table('user')->insert([
            'name' => 'Afrah',
            'email' => 'afrah@gmail.com',
            'age' => 20,
        ]);
           
    }
}
