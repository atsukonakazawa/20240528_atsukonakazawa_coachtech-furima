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
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/1.jpg',
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
            'item_detail' => 'このハンドクリームはとても気に入っていて、1年ほど前にストックとして購入したのですが、妊娠を機に香りが強いものがNGとなってしまったため出品します。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/2.jpg',
            'item_price' => '1400'
        ];
        DB::table('items')->insert($param);

        $param = [
            'seller_id' => '3',
            'main_category_id' => '1',
            'sub_category_id' => '3',
            'condition_id' => '1',
            'color_id' => '2',
            'item_name' => 'プリンセス　靴下',
            'item_brand' => 'ディズニー',
            'item_detail' => 'とても嬉しい頂き物でしたがサイズが合わず残念ながらはけませんでした。プリンセス好きな子にいかがでしょうか？サイズは12~18センチで、写真の通り3足セットです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/3.jpg',
            'item_price' => '1500'
        ];
        DB::table('items')->insert($param);

        $param = [
            'seller_id' => '1',
            'main_category_id' => '2',
            'sub_category_id' => '4',
            'condition_id' => '1',
            'color_id' => '5',
            'item_name' => 'ハンドメイド　ラベンダースワッグ',
            'item_detail' => 'こちらはフェイクグリーン（造花）で作ったラベンダーとグリーンのスワッグです。屋外にも飾れますが、直射日光や雨風が当たらない場所で飾っていただく方が綺麗な状態が長続きします。フェイクなのでお手入れいらずで気軽にお楽しみいたけます。サイズはおおよそ縦25センチ、横15センチ、厚みが10センチです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/4.jpg',
            'item_price' => '2700'
        ];
        DB::table('items')->insert($param);

        $param = [
            'seller_id' => '2',
            'main_category_id' => '2',
            'sub_category_id' => '3',
            'condition_id' => '2',
            'color_id' => '10',
            'item_name' => 'キッズサングラス',
            'item_brand' => 'petit main',
            'item_detail' => '娘が大変気に入って使っていたものです。もう小さくなってしまったのですが、なんとなく捨てるのも寂しく、どなたかにまた使っていただきたいと思い出品しました。目立った傷などはありませんが、子供が使っていたものなのでよく見ると細かく小さな傷はあります。Usedにご理解のある方にぜひご検討いただけたら嬉しいです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/5.jpg',
            'item_price' => '700'
        ];
        DB::table('items')->insert($param);

        $param = [
            'seller_id' => '3',
            'main_category_id' => '3',
            'sub_category_id' => '3',
            'condition_id' => '2',
            'color_id' => '3',
            'item_name' => '離乳食　本',
            'item_brand' => '学研',
            'item_detail' => '子供が0際の時はこちらをよく参考にして離乳食を作っていました。写真やイラストが多く見やすかったです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/6.jpg',
            'item_price' => '500'
        ];
        DB::table('items')->insert($param);

        $param = [
            'seller_id' => '1',
            'main_category_id' => '4',
            'sub_category_id' => '2',
            'condition_id' => '1',
            'color_id' => '9',
            'item_name' => 'メンズ　シェーバー',
            'item_brand' => 'BRAUN',
            'item_detail' => '会社のビンゴ大会で獲得したのですが、主人は決まったものを使っているので不要となってしまいました。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/7.jpg',
            'item_price' => '3000'
        ];
        DB::table('items')->insert($param);

        $param = [
            'seller_id' => '2',
            'main_category_id' => '1',
            'sub_category_id' => '3',
            'condition_id' => '2',
            'color_id' => '5',
            'item_name' => 'キッズワンピース　キッズドレス',
            'item_brand' => 'Ruffle Butts',
            'item_detail' => '娘のお気に入りでしたがサイズアウトにつき出品します。サイズは100センチです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/8.jpg',
            'item_price' => '2500'
        ];
        DB::table('items')->insert($param);

        $param = [
            'seller_id' => '3',
            'main_category_id' => '4',
            'sub_category_id' => '1',
            'condition_id' => '1',
            'color_id' => '2',
            'item_name' => 'ミスディオール　オードゥパルファン',
            'item_brand' => 'Dior',
            'item_detail' => '頂き物ですが今は違うものを使っているので未使用のままです。内容量は30mlです。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/9.jpg',
            'item_price' => '11000'
        ];
        DB::table('items')->insert($param);

        $param = [
            'seller_id' => '1',
            'main_category_id' => '5',
            'sub_category_id' => '4',
            'condition_id' => '1',
            'color_id' => '8',
            'item_name' => 'ハンドメイド　ダイニングテーブル',
            'item_detail' => 'フレンチカントリーがお好きな方に。天然木を使用したハンドメイドのダイニングテーブルです。椅子もセットでご希望でしたらコメントにてご相談ください。長さ150センチ、幅100センチ、高さ100センチです。また配送方法もコメントにてご相談ください。',
            'item_img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/items/10.jpg',
            'item_price' => '100000'
        ];
        DB::table('items')->insert($param);
    }
}
