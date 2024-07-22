#サービス名’coachtechフリマ'  
<img width="1699" alt="coachtech-furimaトップ画面" src="https://github.com/user-attachments/assets/740e4a7b-66a9-4699-aea8-3e69a276f01e">  

 
  
 ##サービス概要  
 ある企業が開発した独自のフリマアプリ  


   
 ##制作の背景と目的  
 coachtechブランドのアイテムを出品する  


  
  ##デプロイ  
  1 アプリケーションURL: (デプロイ後に記載）  
  2 デプロイ先:  
  3 DB:  
  4 ストレージ:  
  5 サーバー:nginx/1.22.1  


  
   ##他のリポジトリ  
   特になし  


      
   ##機能一覧  
   会員登録  
   ログイン  
   ログアウト  
   商品一覧取得  
   商品詳細取得  
   商品お気に入り一覧取得  
   ユーザー情報取得  
   ユーザー購入商品一覧取得  
   ユーザ出品商品一覧取得  
   プロフィール変更  
   商品お気に入り追加  
   商品お気に入り削除  
   商品コメント追加  
   商品コメント削除  
   出品  
   配送先変更機能  
   商品購入機能  
   支払い方法の選択・変更  
   レスポンシブデザイン（ブレイクポイント768px)  
   管理者によるユーザー・コメントの削除  
   管理者から利用者へのメール送信  
   商品の画像をストレージに保存  


  
   ##使用技術  
   Laravel Framework 8.83.8  
   PHP 8.3.6 (cli)  
   MySQL 8.0.26 - MySQL Community Server - GPL  


  
   ##テーブル設計  
   <img width="1287" alt="coachtech-furima　テーブル設計１" src="https://github.com/user-attachments/assets/795aa157-b98f-431a-9507-32865acf0754">  

   <img width="1285" alt="coachtech-furima　テーブル設計２" src="https://github.com/user-attachments/assets/f33ec5d4-b6db-42f2-8ddf-fab2a981d0a2">  


  
   ##ER図  
   <img width="900" alt="coachtesh-furima　ER図" src="https://github.com/user-attachments/assets/b06d0b69-b2c2-486e-a854-d166b17fdaf6">  


  
   ##ローカル環境構築  
   1 git clone git@github.com:coachtech-material/laravel-docker-template.git  
   2 docker compose up -d --build  
     ※MySQLは、OSによっては起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。  
   3 cp .env.example .env  
   ・DBの部分を以下の通りに編集  
    DB_CONNECTION=mysql  
    DB_HOST=mysql  
    DB_PORT=3306  
    DB_DATABASE=laravel_db  
    DB_USERNAME=laravel_user  
    DB_PASSWORD=laravel_pass  
      
   ・MAILの部分を以下の通りに編集  
    MAIL_MAILER=smtp  
    MAIL_HOST=mail  
    MAIL_PORT=1025  
    MAIL_USERNAME=null  
    MAIL_PASSWORD=null  
    MAIL_ENCRYPTION=null  
    MAIL_FROM_ADDRESS=info@coachtechfurima.com  
    MAIL_FROM_NAME="${APP_NAME}"  

   ・STRIPEに関する記述を以下の通り追加  
     STRIPE_KEY=pk_test_51PBdN3IzbSIU1MHKVrPia3U5vPPiCmZsXye7h4EBpq1lwvdm3QEMWaeagHaPEvDagt5EZSETtzIqJMEuWKjnXTn90024rKvEpx  
     STRIPE_SECRET=sk_test_51PBdN3IzbSIU1MHK4NpwExQfpOQBtRpoPilzRXD0IWXMy9ejcY89jGzVl16pUOcF85lkkZXFRROtFJDoYERI3AjK00jSboz6Vn  
    CASHIER_CURRENCY=jpy  
   4 docker-compose.ymlを以下の通り編集  
   ・versionの下に以下のvolumesを追加  
     volumes:  
      db-volume:  
      maildir: {}  
         
   ・services:に以下のmailhogの内容を追加  
     mail:  
       image: mailhog/mailhog  
       container_name: mailhog  
       ports:  
         - 1025:1025  
         - 8025:8025  
       environment:  
         MH_STORAGE: maildir  
         MH_MAILDIR_PATH: /tmp  
       volumes:  
         - maildir:/tmp  
 
   ・servicesのmysqlとphpmyadminに以下の内容を追加  
     image:の次の行に  
       platform: linux/x86_64  
   5 再度docker compose up -d --build  

   ##Laravel環境構築  
   1 composer install  
   2 マイグレーションテーブル・モデル・シーダーファイルを作成  
   3 php artisan db:seed  
     ※DatabaseSeeder.phpに記載されている通りの順で５回に分けてシードする     
   4 fortify導入  
       composer require laravel/fortify  
       php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"  
       composer require laravel-lang/lang:~7.0 --dev  
       cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/      
   5 php artisan migrate  
   6 php artisan key:generate  
   7 php artisan storage:link  
   8 ４１３TooMuchEntityのエラー対策として  
     docker/nginx/default.confに以下の内容を追加  
     client_max_body_size 10M;  
   9 画像ファイルアップロードの見た目をカスタマイズするために  
     ・jQueryをインストール  srcに移動し　npm install jquery  
    　　・webpack.mix.jsに以下の内容を追加  
     .sass('resources/sass/app.scss', 'public/css')
     .autoload({
         jquery: ['$', 'window.jQuery', 'jQuery'],
     })  
      
   ・resources/js/app.jsに以下の内容を追加  
     import $ from 'jquery';　　
     window.$ = window.jQuery = $;  
      
   ・npm install  
    
   ・（npm run devを実行時に指示が出たため）  
    npm install sass-loader@^12.1.0 sass resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps  
    mkdir resources/sass  
    touch resources/sass/app.scss  
     
   ・npm run dev    
   10 Laravel Cashierのインストール  
   ・composer require laravel/cashier  
    
   ・php artisan migrate:fresh  
    
   ・ダミーデータを再度５回に分けてシードする  
   11 PHPunitでテスト  
   ・mysqlコンテナに入り、mysql -u root -p(パスワードはroot)を実行  

   ・CREATE DATABASE demo_test;  

   ・config/database.phpに書かれているmysqlのセクションをコピー・すぐ下にペーストする  

   ・ペーストした部分の以下4箇所を変更する  
     a.変更前　mysql 変更後　mysql_test  
     b.変更前　'database' => env('DB_DATABASE', 'forge') 　変更後　'database' => 'demo_test',  
     c.変更前　'username' => env('DB_USERNAME', 'forge')　　変更後 'username' => 'root',  
     d.変更前　'password' => env('DB_PASSWORD', '')　　変更後 'password' => 'root',  

   ・PHPコンテナに入り、以下を実行  

   ・cp .env .env.testing  

   ・src/.env.testingを編集する  
     a.　変更前　APP_ENV=local　変更後　APP_KEY=(テスト用キー作成のため一度からにする）  
     b.　変更前　DB_DATABASE=laravel_db　変更後　DB_DATABASE=demo_test  
     c. 変更前 DB_USERNAME=laravel_user 変更後　　DB_USERNAME=root  
     d.　変更前　DB_PASSWORD=laravel_pass　変更後　DB_PASSWORD=root  

   ・php artisan key:generate --env=testing  

   ・php artisan config:clear　　

   ・php artisan migrate --env=testing  

   ・src/phpunit.xmlを編集する  
     a.　変更前　<!-- <server name="DB_CONNECTION" value="sqlite"/> -->  
        変更後　<server name="DB_CONNECTION" value="mysql_test"/>　  
     b. 変更前　<!-- <server name="DB_DATABASE" value=":memory:"/> -->  
        変更後 <server name="DB_DATABASE" value="demo_test"/>  

   ・データベースのテストをする  
     vendor/bin/phpunit tests/Feature/HelloTest.php  

      

   ##テストユーザー情報(ダミーデータに登録済のためシード後にログイン可能になります）  
   1 name: a-admin(管理者)  
     email: a@docomo.com  
     password: aaaaaaaa  
      
   2 name: b(一般ユーザー)    
     email: b@docomo.com  
     password: bbbbbbbb  
      
   3 name: c(一般ユーザー)  
     email: c@docomo.com  
     password: cccccccc  


  
   ##デプロイ  
   1 EC2インスタンスの作成  
   2 nginxのインストール・自動起動化  
   3 RDS DBインスタンスを作成  
   4 sudo yum update -y  
   5 sudo yum -y install mysql git httpd curl  
   6 git config --global user.name "atsukonakazawa"  
   7 git config --global user.email tsqe8qm1bmqztbxbjre9@docomo.ne.jp  
   8 sudo amazon-linux-extras install -y php8.2  
   9 curl -sS https://getcomposer.org/installer | php  
   10 sudo mv composer.phar /usr/local/bin/composer  
   11 cd /var/www  
   12 sudo chown ec2-user:ec2-user /var/www  
   13 git clone 
   
