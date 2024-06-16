<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'color' => 'レッド系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'ピンク系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'オレンジ系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'イエロー系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'グリーン系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'ブルー系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'パープル系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'ブラウン系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'ブラック系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'ホワイト系'
        ];
        DB::table('colors')->insert($param);

        $param = [
            'color' => 'その他'
        ];
        DB::table('colors')->insert($param);

    }
}
