<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this->call([
					ProfileTableSeeder::class,
					UserTableSeeder::class,
					CommunityTableSeeder::class,
					PostTableSeeder::class,
          FollowingTableSeeder::class,
          NotificationTableSeeder::class,
          LikeDislikeTableSeeder::class,
					]);
    }
}
