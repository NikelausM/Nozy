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
            'password' => '123',
            'description' => 'Hello my name is Nicolas',
        ]);

        DB::table('profile')->insert([
            'name' => 'Naweed',
            'password' => '456',
            'description' => 'Hello my name is Naweed',
        ]);

        DB::table('profile')->insert([
            'name' => 'Afrah',
            'password' => '789',
            'description' => 'Hello my name is Afrah',
        ]);

        DB::table('profile')->insert([
            'name' => 'Gaming',
            'password' => '123',
            'description' => 'This community is dedicated to all gaming related discussion',
        ]);

        DB::table('profile')->insert([
            'name' => 'University Of Calgary',
            'password' => '123',
            'description' => 'This community is dedicated to all University of Calgary related discussion',
        ]);

        DB::table('profile')->insert([
            'name' => 'Sports',
            'password' => '123',
            'description' => 'This community is dedicated to all sports related discussion',
        ]);

        DB::table('profile')->insert([
            'name' => 'Chess',
            'password' => '123',
            'description' => 'This community is dedicated to all chess related discussion',
        ]);
    }
}
