<?php

use Illuminate\Database\Seeder;
use \App\Following;
use \App\Profile;

class FollowingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert user data into user table
        Following::create(array(
          'followingable_id'=> 2,
          'followingable_type'=> get_class(new Profile()),
          'follower_id'=> 1,
        ));

        Following::create(array(
          'followingable_id'=> 3,
          'followingable_type'=> get_class(new Profile()),
          'follower_id'=> 1,
        ));
    }
}
