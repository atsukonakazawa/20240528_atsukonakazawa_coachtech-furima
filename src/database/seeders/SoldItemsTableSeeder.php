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
            'seller_id' => '1',
            'buyer_id' => '2',
            'main_category_id' => '2',
            'sub_category_id' => '3',
            'condition_id' => '2',
            'color_id' => '8',
            'payment_way_id' => '1',
            'item_name' => '知育パズル',
            'item_detail' => '子供が大変気に入っていましたが、すぐにコツを覚えて使わなくなりました。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/1.jpg',
            'item_price' => '777'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '2',
            'buyer_id' => '3',
            'main_category_id' => '3',
            'sub_category_id' => '4',
            'condition_id' => '2',
            'color_id' => '11',
            'payment_way_id' => '2',
            'item_name' => 'ハリーポッターシリーズ　書籍',
            'item_detail' => 'ずっと大切にしていましたが、引越でさよならすることになりました。名残惜しいですが、またどなたかに大切に使っていただけたら大変嬉しいです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/2.jpg',
            'item_price' => '5000'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '3',
            'buyer_id' => '1',
            'main_category_id' => '1',
            'sub_category_id' => '1',
            'condition_id' => '2',
            'color_id' => '5',
            'payment_way_id' => '2',
            'item_name' => 'ヘアバンド　ターバン',
            'item_detail' => '気に入っていましたが髪型を変えて使わなくなりました。周りからとても好評でした！',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/3.jpg',
            'item_price' => '700'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '1',
            'buyer_id' => '2',
            'main_category_id' => '4',
            'sub_category_id' => '4',
            'condition_id' => '1',
            'color_id' => '8',
            'payment_way_id' => '1',
            'item_name' => 'ココネ　クレンジングシャンプー',
            'item_detail' => '愛用し始めてから随分経ちますが、まだまだ気に入って使っています🎵定期便のペースに追いつかず溜まってしまっているので出品します。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/4.jpg',
            'item_price' => '3500'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '2',
            'buyer_id' => '3',
            'main_category_id' => '1',
            'sub_category_id' => '2',
            'condition_id' => '2',
            'color_id' => '8',
            'payment_way_id' => '3',
            'item_name' => 'メンズ　サンダル',
            'item_detail' => '2ヶ月前にネット購入したのですがサイズを間違えました。家で試し履きを1度しましたが、外では履いていません。かかとが抜けにくい作りになっているので、子供と川で遊んだりする時も安心して履けそうです。商品のサイズは28センチです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/5.jpg',
            'item_price' => '4000'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '3',
            'buyer_id' => '1',
            'main_category_id' => '1',
            'sub_category_id' => '3',
            'condition_id' => '2',
            'color_id' => '6',
            'payment_way_id' => '1',
            'item_name' => 'キッズ　サマーワンピース',
            'item_detail' => '去年の夏に娘が着ていたものです。花柄が可愛いのと生地が薄くてもしっかりしているので、ヨレたり型崩れはしておらず、良いお品だと思います。購入時と比べると少し色褪せがあるかもしれませんが、私は全く気にならないレベルでした。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/6.jpg',
            'item_price' => '1600'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '1',
            'buyer_id' => '2',
            'main_category_id' => '1',
            'sub_category_id' => '3',
            'condition_id' => '2',
            'color_id' => '7',
            'payment_way_id' => '1',
            'item_name' => 'ラプンツェル　ドレス',
            'item_detail' => '娘が4歳の時にお気に入りでした。何度か自宅で洗濯ネットを二重にして洗濯機で洗濯した際にスカートの裾野レースが一部剥がれてしまったので手縫いで直した部分があります。その他汚れなどは見当たりません。サイズは100サイズです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/7.jpg',
            'item_price' => '1500'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '2',
            'buyer_id' => '3',
            'main_category_id' => '2',
            'sub_category_id' => '4',
            'condition_id' => '2',
            'color_id' => '9',
            'payment_way_id' => '2',
            'item_name' => '財布　本革',
            'item_detail' => '2年ほど大事に使っていましたが、長財布に変えることにしたので、こちらは出品します。まだまだ綺麗です。カラーは写真の上にあるブラックです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/8.jpg',
            'item_price' => '4500'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '3',
            'buyer_id' => '1',
            'main_category_id' => '5',
            'sub_category_id' => '4',
            'condition_id' => '1',
            'color_id' => '4',
            'payment_way_id' => '1',
            'item_name' => 'ミモザ　アートポスター',
            'item_detail' => 'ハンドメイドのアートポスターです。ミモザの色味で玄関やお部屋が優しく華やかな雰囲気になります。また、額縁もセットなので届いたらすぐに飾っていただけます。縦50センチ、横30センチ、厚みは4センチ程になります。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/9.jpg',
            'item_price' => '2000'
        ];
        DB::table('sold_items')->insert($param);

        $param = [
            'seller_id' => '1',
            'buyer_id' => '2',
            'main_category_id' => '2',
            'sub_category_id' => '3',
            'condition_id' => '2',
            'color_id' => '2',
            'payment_way_id' => '1',
            'item_name' => 'キッズテント　ライト',
            'item_detail' => '娘が大好きだったテントですが、もう大きくなったので卒業します。写真にあるテント・カーテン・イルミネーションライトをセットにして出品いたします（テント内のクッション・人形は含まれません）。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/sold_items/10.jpg',
            'item_price' => '5000'
        ];
        DB::table('sold_items')->insert($param);

    }
}
