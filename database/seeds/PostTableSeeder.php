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
        // Insert user data into user table (need to use Model::create() so that data and time is inserted)
        \App\Post::create(array(
            'title' => 'Working from home',
            'rating' => 0,
            'description' => 'It\s pretty interesting working from home rather than school.',
            'posted_on_profile_id' => 1,
            'posted_by_profile_id' => 1,
        ));

        \App\Post::create(array(
            'title' => 'Who\'s excited for Elden Ring?',
            'rating' => 0,
            'description' => 'I think it\'s going to be amazing. I just hope that they make the lore as rich as the Dark Souls games.',
            'posted_on_profile_id' => 4,
            'posted_by_profile_id' => 1,
        ));

        \App\Post::create(array(
            'title' => 'Halo Infinite Coming Out',
            'rating' => 0,
            'description' => 'I can\'t wait for the new Halo game to come out, but what do you guys think?',
            'posted_on_profile_id' => 4,
            'posted_by_profile_id' => 1,
        ));

        \App\Post::create(array(
            'title' => 'Coronavirus Update',
            'rating' => 0,
            'description' => 'I wonder what the administration is going to do about final exams.',
            'posted_on_profile_id' => 5,
            'posted_by_profile_id' => 2,
        ));
    }
}
