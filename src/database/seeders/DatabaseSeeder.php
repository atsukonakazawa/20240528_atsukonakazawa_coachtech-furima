<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ////１回目のseed
        ////マスター
        //$this->call(MainCategoriesTableSeeder::class);
        //$this->call(SubCategoriesTableSeeder::class);
        //$this->call(ConditionsTableSeeder::class);
        //$this->call(ColorsTableSeeder::class);
        //$this->call(PaymentWaysTableSeeder::class);
        ////ユーザー
        //$this->call(UsersTableSeeder::class);

        ////2回目のseed
        ////プロフィール
        //$this->call(ProfilesTableSeeder::class);

        ////3回目のseed
        ////販売中商品
        //$this->call(ItemsTableSeeder::class);

        ////４回目のseed
        ////売り切れ商品
        //$this->call(SoldItemsTableSeeder::class);

        ////5回目のseed
        ////商品に対するコメント、お気に入り
        //$this->call(CommentsTableSeeder::class);
        //$this->call(FavoritesTableSeeder::class);
    }
}
