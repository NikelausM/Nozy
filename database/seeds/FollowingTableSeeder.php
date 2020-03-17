<?php

use Illuminate\Database\Seeder;

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
        DB::table('following')->insert([
          'follower_id'=> 1,
          'followee_id'=> 2,
          'type'=> 'profile',
        ]);

        DB::table('following')->insert([
          'follower_id'=> 1,
          'followee_id'=> 3,
          'type'=> 'profile',
        ]);
    }
}
