<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'condition' => '新品・未開封・未使用'
        ];
        DB::table('conditions')->insert($param);

        $param = [
            'condition' => '目立った傷や汚れなし'
        ];
        DB::table('conditions')->insert($param);

        $param = [
            'condition' => '目立った傷や汚れあり'
        ];
        DB::table('conditions')->insert($param);
    }
}
