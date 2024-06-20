<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'a-admin',
            'role' => 'admin',
            'email' => 'a@docomo.com',
            'password' => Hash::make('aaaaaaaa'), // パスワードをハッシュ化
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'b',
            'email' => 'b@docomo.com',
            'password' => Hash::make('bbbbbbbb'), // パスワードをハッシュ化
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'c',
            'email' => 'c@docomo.com',
            'password' => Hash::make('cccccccc'), // パスワードをハッシュ化
        ];
        DB::table('users')->insert($param);

    }
}
