<?php

use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert user data into user table (need to use Model::create() so that date and time is inserted)
        \App\Notification::create(array(
          'notifee_id' => 2,
    			'post_id' => 1,
          'notification_type' => 'Tester notification',
          'profile_id' => 1,
        ));

    }
}
