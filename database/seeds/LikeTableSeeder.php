<?php

use Illuminate\Database\Seeder;

class LikeDislikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\LikeDislike::create(array(
            'type' => 'like',
            'post_id' => 1,
            'profile_id' => 1,
        ));

        \App\LikeDislike::create(array(
            'type' => 'like',
            'post_id' => 2,
            'profile_id' => 1,
        ));

        \App\LikeDislike::create(array(
            'type' => 'dislike',
            'post_id' => 3,
            'profile_id' => 1,
        ));
    }
}
