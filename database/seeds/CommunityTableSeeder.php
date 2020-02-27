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
            'name' => 'Gaming',
            'managed_by' => 'Nicolas',
        ]);
        
        DB::table('community')->insert([
            'name' => 'UniversityOfCalgary',
            'managed_by' => 'Nicolas',
        ]);
        
        DB::table('community')->insert([
            'name' => 'Sports',
            'managed_by' => 'Afrah',
        ]);
    }
}
