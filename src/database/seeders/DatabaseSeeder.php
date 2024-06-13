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
        //マスター
        //$this->call(MainCategoriesTableSeeder::class);
        //$this->call(SubCategoriesTableSeeder::class);
        //$this->call(ConditionsTableSeeder::class);
        //$this->call(PaymentWaysTableSeeder::class);

        //ユーザー
        //$this->call(UsersTableSeeder::class);

        //プロフィール
        //$this->call(ProfilesTableSeeder::class);

        //商品
        //$this->call(ItemsTableSeeder::class);
        //$this->call(SoldItemsTableSeeder::class);

        //商品に対するコメント、お気に入り
        $this->call(CommentsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
    }
}
