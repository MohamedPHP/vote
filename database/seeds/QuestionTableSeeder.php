<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('questions')->truncate();
        DB::table('answers')->truncate();
        /*
        `content`, `total_voting`, `supportes_counter`, `aopposed_counter`, `unintersted_counter`
        */
        $questions = [
            [
                'content'           =>'do you love cc',
                'total_voting'      => 0,
                'supportes_counter' => 0,
                'aopposed_counter'  => 0,
                'unintersted_counter'=>0,
            ],
            [
                'content'           =>'do you love ardo8an',
                'total_voting'      => 0,
                'supportes_counter' => 0,
                'aopposed_counter'  => 0,
                'unintersted_counter'=> 0,
            ],
        ];
        DB::table('questions')->insert($questions);
    }
}
