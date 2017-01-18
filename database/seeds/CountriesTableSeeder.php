<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('countries')->truncate();
        $c = [
            [
                'name' => 'Egypt'
            ],
            [
                'name' => 'America'
            ],
        ];
        DB::table('countries')->insert($c);
    }
}
