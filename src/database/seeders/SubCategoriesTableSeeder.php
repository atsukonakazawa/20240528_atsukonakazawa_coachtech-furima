<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'sub_category' => 'レディス'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'sub_category' => 'メンズ'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'sub_category' => 'キッズ・ベビー'
        ];
        DB::table('sub_categories')->insert($param);

        $param = [
            'sub_category' => 'その他'
        ];
        DB::table('sub_categories')->insert($param);
    }
}
