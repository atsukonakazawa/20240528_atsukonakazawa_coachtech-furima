<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
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
            'user_id' => '2'
        ];
        DB::table('favorites')->insert($param);

        $param = [
            'item_id' => '2',
            'sold_item_id' => null,
            'user_id' => '1'
        ];
        DB::table('favorites')->insert($param);

        $param = [
            'item_id' => null,
            'sold_item_id' => '2',
            'user_id' => '1'
        ];
        DB::table('favorites')->insert($param);


    }
}
