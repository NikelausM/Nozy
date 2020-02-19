<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert user data into user table
        DB::table('profile')->insert([
            'email' => 'nicolas@gmail.com',
            'name' => 'Nicolas',
            'description' => 'Hello my name is Nicolas',
        ]);
        
        DB::table('profile')->insert([
            'email' => 'naweed@gmail.com',
            'name' => 'Naweed',
            'description' => 'Hello my name is Naweed',
        ]);
        
        DB::table('profile')->insert([
            'email' => 'afrah@gmail.com',
            'name' => 'Afrah',
            'description' => 'Hello my name is Afrah',
        ]);
        
    }
}
