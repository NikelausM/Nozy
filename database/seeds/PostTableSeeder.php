<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert user data into user table
        DB::table('post')->insert([
            'title' => 'Who\'s excited for Elden Ring?',
            'rating' => 0,
            'description' => 'I think it\'s going to be amazing. I just hope that they make the lore as rich as the Dark Souls games.',
            'parent_id' => 4,
        ]);
        
        DB::table('post')->insert([
            'title' => 'Halo Infinite Coming Out',
            'rating' => 0,
            'description' => 'I can\'t wait for the new Halo game to come out, but what do you guys think?',
            'parent_id' => 4,
        ]);
        
        DB::table('post')->insert([
            'title' => 'Coronavirus Update',
            'rating' => 0,
            'description' => 'I wonder what the administration is going to do about final exams.',
            'parent_id' => 5,
        ]);

        DB::table('post')->insert([
            'title '=> 'I am a gulab',
            'rating' => 0,
            'description' => 'I have just realized I have been a gulab my entire life.',
            'parent_id' => 1,
        ]);
    }
}
