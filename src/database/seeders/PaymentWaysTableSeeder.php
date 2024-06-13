<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentWaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'payment_way' => 'クレジットカード'
        ];
        DB::table('payment_ways')->insert($param);

        $param = [
            'payment_way' => 'コンビニ'
        ];
        DB::table('payment_ways')->insert($param);

        $param = [
            'payment_way' => '銀行振込'
        ];
        DB::table('payment_ways')->insert($param);
    }
}
