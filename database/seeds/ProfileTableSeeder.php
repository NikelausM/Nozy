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
            'name' => 'Nicolas',
            'description' => 'Hello my name is Nicolas',
        ]);
        
        DB::table('profile')->insert([
            'name' => 'Naweed',
            'description' => 'Hello my name is Naweed',
        ]);
        
        DB::table('profile')->insert([
            'name' => 'Afrah',
            'description' => 'Hello my name is Afrah',
        ]);
        
        DB::table('profile')->insert([
            'name' => 'Gaming',
            'description' => 'This community is dedicated to all gaming related discussion',
        ]);
        
        DB::table('profile')->insert([
            'name' => 'UniversityOfCalgary',
            'description' => 'This community is dedicated to all University of Calgary related discussion',
        ]);
        
        DB::table('profile')->insert([
            'name' => 'Sports',
            'description' => 'This community is dedicated to all sports related discussion',
        ]);
    }
}
