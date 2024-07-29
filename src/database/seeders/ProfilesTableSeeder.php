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
            'postcode' => '1050011',
            'address' => '東京都港区芝公園1-1-1',
            'building' => '東京タワービル',
            'img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/profiles/a@docomo.com.jpg',
        ];
        DB::table('profiles')->insert($param);

        $param = [
            'user_id' => '2',
            'nickname' => 'b',
            'postcode' => '1310045',
            'address' => '東京都墨田区押上１丁目１−２',
            'building' => 'スカイツリービル',
            'img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/profiles/b@docomo.com.jpg',
        ];
        DB::table('profiles')->insert($param);

        $param = [
            'user_id' => '3',
            'nickname' => 'c',
            'postcode' => '2208522',
            'address' => '神奈川県横浜市西区みなとみらい１丁目１−１',
            'img' => 'https://coachtech-furima-bucket.s3.ap-northeast-1.amazonaws.com/profiles/c@docomo.com.jpg',
        ];
        DB::table('profiles')->insert($param);

    }
}
