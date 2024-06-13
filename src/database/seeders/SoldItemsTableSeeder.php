<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoldItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'seller_id' => '2',
            'buyer_id' => '1',
            'main_category_id' => '2',
            'sub_category_id' => '3',
            'condition_id' => '2',
            'payment_way_id' => '1',
            'item_name' => '知育パズル',
            'item_color' => 'ブラウン',
            'item_detail' => '子供が大変気に入っていましたが、すぐにコツを覚えて使わなくなりました。',
            'item_img' => 'storage/big-pieces-puzzle.jpg',
            'item_price' => '777'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '1',
            'buyer_id' => '2',
            'main_category_id' => '3',
            'sub_category_id' => '4',
            'condition_id' => '2',
            'payment_way_id' => '2',
            'item_name' => 'ハリーポッターシリーズ　書籍',
            'item_detail' => 'ずっと大切にしていましたが、引越でさよならすることになりました。名残惜しいですが、またどなたかに大切に使っていただけたら大変嬉しいです。',
            'item_img' => 'storage/harrypotter-book.jpg',
            'item_price' => '5000'
        ];
        DB::table('sold_items')->insert($param);

    }
}
