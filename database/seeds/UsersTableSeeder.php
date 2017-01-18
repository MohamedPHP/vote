<?php
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        /*
        `id``username``img_path``phone``email``password``country_id``remember_token``created_at``updated_at`
        */
        $Users = [
            [
                'username'           => 'Mohamed',
                'img_path'     => 'src/images/users/avatar.png',
                'phone'    => '01127946754',
                'email'     => 'mohamedzayed79@yahoo.com',
                'password'     => bcrypt('123123'),
                'country_id'        => 1,
            ],
        ];
        DB::table('users')->insert($Users);
    }
}
