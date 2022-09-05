<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class QuizTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quiz_type')->insert([
            'name' => 'Multiple Choice',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Multiple Response',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'True/False',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Short Answer',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Numeric',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Sequence',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Matching',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Fill in the Blanks',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Select from Lists',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Hotspot',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Info Slide',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Quiz Instructions',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Passed',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'Failed',
        ]);
        DB::table('quiz_type')->insert([
            'name' => 'User Info Form',
        ]);
    }
}
