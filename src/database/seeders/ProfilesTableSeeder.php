<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '1',
            'nickname' => 'a',
            'postcode' => '1111111',
            'address' => 'a',
            'building' => 'a',
            'img' => 'storage/a@docomo.com.jpg',
            'introduction' => '仕事や育児の合間にお取引させていただきます。そのため、ご購入いただいてもすぐに発送できない場合があります。品物の到着をお急ぎの方は購入前にコメントにてお知らせください。子供のUSED品や断捨離により不要になったものの出品が多くなるかと思います。よろしくお願いいたします。'
        ];
        DB::table('profiles')->insert($param);

        $param = [
            'user_id' => '2',
            'nickname' => 'b',
            'postcode' => '22222222',
            'address' => 'b',
            'building' => 'b',
            'img' => 'storage/b@docomo.com.jpg',
            'introduction' => '初心者です。よろしくお願いいたします。'
        ];
        DB::table('profiles')->insert($param);

    }
}
