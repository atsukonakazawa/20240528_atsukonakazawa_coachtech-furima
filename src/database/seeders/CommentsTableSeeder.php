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
            'item_id' => '2',
            'sold_item_id' => null,
            'user_id' => '3',
            'comment' => 'こんにちは。失礼ですが、こちら1年前に購入されているということでしたので、1000円くらいにお値下げをご検討いただけないでしょうか？'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => '4',
            'sold_item_id' => null,
            'user_id' => '2',
            'comment' => 'はじめまして。こちらはハンドメイドとのことですが、同じものをもう１つお作りいただき、２つ購入することは可能でしょうか？'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => '4',
            'sold_item_id' => null,
            'user_id' => '1',
            'comment' => 'bさま　コメントをありがとうございます。1週間ほどお日にちを頂けますと、もう1つお作りすることができます。その場合は、おまとめ割引もさせていただき2つ合わせて5000円でいかがでしょうか？ご検討をよろしくお願い致します。'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => '4',
            'sold_item_id' => null,
            'user_id' => '2',
            'comment' => 'ありがとうございます。ぜひそちらの内容でお願い致します。'
        ];
        DB::table('comments')->insert($param);


        $param = [
            'item_id' => '10',
            'sold_item_id' => null,
            'user_id' => '2',
            'comment' => '椅子４脚も希望した場合、テーブルと合わせてお値段はどれくらいになりますか？'
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
            'comment' => 'a-adminさま　コメントありがとうございます。およそ6年前頃に購入したと記憶しています。'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => null,
            'sold_item_id' => '7',
            'user_id' => '2',
            'comment' => 'こんばんは。こちら写真にある小物も全てつきますか？'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => null,
            'sold_item_id' => '7',
            'user_id' => '1',
            'comment' => 'bさま　コメントありがとうございます。小物も全てつきます。よろしくお願いします。'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => null,
            'sold_item_id' => '9',
            'user_id' => '1',
            'comment' => 'こちらを購入した際には、配達の時間帯を夜間に指定することは可能でしょうか？'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => null,
            'sold_item_id' => '9',
            'user_id' => '3',
            'comment' => 'a-adminさま　ありがとうございます。夜間に配達する旨指定することが可能です。'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'item_id' => null,
            'sold_item_id' => '9',
            'user_id' => '1',
            'comment' => 'ありがとうございます。購入させていただきますので上記の内容でご指定をお願い致します。'
        ];
        DB::table('comments')->insert($param);


    }
}
