<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'main_category' => 'ファッション'
        ];
        DB::table('main_categories')->insert($param);

        $param = [
            'main_category' => 'グッズ'
        ];
        DB::table('main_categories')->insert($param);

        $param = [
            'main_category' => '本・雑誌・漫画'
        ];
        DB::table('main_categories')->insert($param);

        $param = [
            'main_category' => '美容・健康'
        ];
        DB::table('main_categories')->insert($param);

        $param = [
            'main_category' => 'その他'
        ];
        DB::table('main_categories')->insert($param);
    }
}
