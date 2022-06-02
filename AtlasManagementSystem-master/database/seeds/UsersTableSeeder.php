<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
             'over_name' => '一野',
             'under_name' =>'赤太',
             'over_name_kana' => 'イチノ',
             'under_name_kana' => 'アカタ',
             'mail_address' => 'ichino@aaa.com',
             'sex' => '1',
             'birth_day' => '1998/01/01',
             'role' => '4',
             'password' => bcrypt('ichinoichino'),
             'created_at' => new DateTime(),
        ]
        ]);

    }
}