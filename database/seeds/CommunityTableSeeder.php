<?php

use Illuminate\Database\Seeder;

class CommunityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert user data into user table
        DB::table('community')->insert([
            'profile_id' => 4,
            'manager_user_id' => 1,
        ]);
        
        DB::table('community')->insert([
            'profile_id' => 5,
            'manager_user_id' => 1,
        ]);
        
        DB::table('community')->insert([
            'profile_id' => 6,
            'manager_user_id' => 3,
        ]);
    }
}
