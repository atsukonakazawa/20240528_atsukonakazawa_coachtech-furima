<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'item_id' => '1',
            'sold_item_id' => null,
            'user_id' => '2',
            'comment' => 'こんにちは。本日購入した場合、発送はいつになりますか？'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => null,
            'sold_item_id' => '2',
            'user_id' => '1',
            'comment' => '初めまして。こちらはいつ頃購入されたものでしょうか？'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => null,
            'sold_item_id' => '2',
            'user_id' => '2',
            'comment' => 'コメントありがとうございます。およそ6年前頃に購入したと記憶しています。'
        ];
        DB::table('comments')->insert($param);

    }
}
