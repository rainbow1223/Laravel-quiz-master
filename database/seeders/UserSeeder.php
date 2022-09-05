<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Test Admin',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('manager'),
            'active' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Test Student',
            'email' => 'student@gmail.com',
            'password' => bcrypt('student'),
            'active' => true,
        ]);
    }
}
