<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'seller_id' => '1',
            'main_category_id' => '1',
            'sub_category_id' => '3',
            'condition_id' => '1',
            'color_id' => '2',
            'item_name' => 'ロンパース',
            'item_brand' => 'アカチャンホンポ',
            'item_detail' => '頂き物でしたがサイズが合わず一度も着る機会がありませんでした。可愛いのでどなたかに使っていただけたら嬉しいです。',
            'item_img' => 'storage/pink-romper.jpg',
            'item_price' => '1500'
        ];
        DB::table('items')->insert($param);

        $param = [
            'seller_id' => '2',
            'main_category_id' => '4',
            'sub_category_id' => '4',
            'condition_id' => '1',
            'color_id' => '5',
            'item_name' => 'ハンドクリーム',
            'item_brand' => 'ロクシタン',
            'item_detail' => 'このハンドクリームはとても気に入っていて、以前ストックとして購入したのですが、妊娠を機に香りが強いものがNGとなってしまったため出品します。',
            'item_img' => 'storage/loccitane-handcream.jpeg',
            'item_price' => '1400'
        ];
        DB::table('items')->insert($param);

    }
}
