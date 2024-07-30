#サービス名’coachtechフリマ'  
<img width="1699" alt="coachtech-furimaトップ画面" src="https://github.com/user-attachments/assets/740e4a7b-66a9-4699-aea8-3e69a276f01e">  

 
  
 ##サービス概要  
 ある企業が開発した独自のフリマアプリ  


   
 ##制作の背景と目的  
 coachtechブランドのアイテムを出品する  


  
  ##デプロイ  
  1 アプリケーションURL: http://54.168.57.188  
  2 デプロイ先: AWS  
  3 DB: 8.0.26 - MySQL Community Server - GPL  
  4 ストレージ: s3  
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
   PHPUnitを使用してテストを作成済  
  


  
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
   1  git clone git@github.com:coachtech-material/laravel-docker-template.git  
   2  docker compose up -d --build  
      ※MySQLは、OSによっては起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。  
   3  cp .env.example .env  
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
     ・AWSの部分を以下の通りに編集  
      AWS_ACCESS_KEY_ID=AKIA6ODU4LEDH2UFMUFR  
      AWS_SECRET_ACCESS_KEY=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  
      AWS_DEFAULT_REGION=ap-northeast-1  
      AWS_BUCKET=coachtech-furima-bucket  
      AWS_USE_PATH_STYLE_ENDPOINT=false  
     ・STRIPEに関する記述を以下の通り追加   
   　  　STRIPE_KEY=pk_test_51PBdN3IzbSIU1MHKRzghxYsAyukWtQ7Lb3Fywa0zXgxV5gq0R4hFT4FfWpUObQ25LR2IrLeJOCez1WHSPlioOBnW00uNsp07oU  
　　　　　　　　  STRIPE_SECRET=sk_test_51PBdN3IzbSIU1MHKo4Mu47HaPikoVpnOuKSXeLnDbmM6gc7n8XriTj2dlTFap3T4NBROuXKV9GcLR39JDCsHKQJY00Yj7x2y0d 　
      CASHIER_CURRENCY=jpy  
   4  docker-compose.ymlを以下の通り編集  
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
   5  再度docker compose up -d --build  
    
   ##Laravel環境構築  
   1  composer install      
   2  fortify導入  
       composer require laravel/fortify  
       php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"  
       composer require laravel-lang/lang:~7.0 --dev  
       cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/  
   3  php artisan migrate  
   4  php artisan key:generate  
   5  php artisan storage:link  
   6  ４１３TooMuchEntityのエラー対策として  
      docker/nginx/default.confに以下の内容を追加  
      client_max_body_size 10M;  
   7  ・srcに移動し　npm install jquery  
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
   8 Laravel Cashierのインストール  
      ・composer require laravel/cashier  
      ・composer require stripe/stripe-php  
      ・composer.jsonに"stripe/stripe-php": "^7.0"を追記  
      ・php artisan migrate:fresh  
      ・php artisan db:seed  
      ※コメントアウトを外しながら、DatabaseSeeder.phpに記載されている通りの順で５回に分けてシードする  
   9  PHPunitでテスト  
   　　　　　・mysqlコンテナに入り、mysql -u root -p(パスワードはroot)を実行  
　　　　　　　　　　　・CREATE DATABASE demo_test;  
   　　　　　・config/database.phpに書かれているmysqlのセクションをコピー・すぐ下にペーストする  
   　　　　　・ペーストした部分の以下4箇所を変更する  
    　　　　a.変更前　mysql 変更後　mysql_test  
    　　　　b.変更前　'database' => env('DB_DATABASE', 'forge') 　変更後　'database' => 'demo_test',  
    　　　　c.変更前　'username' => env('DB_USERNAME', 'forge')　　変更後 'username' => 'root',  
    　　 d.変更前　'password' => env('DB_PASSWORD', '')　　変更後 'password' => 'root',  
   　　　　　・PHPコンテナで　cp .env .env.testing　を実行  
  　　　　　 ・src/.env.testingを編集する  
    　　　 a.変更前 APP_ENV=local 変更後 APP_ENV=test  
    　　　 b.　変更前　APP_KEY=base64:vPtYQu63T1fmcyeBgEPd0fJ+jvmnzjYMaUf7d5iuB+c=　変更後　APP_KEY=(テスト用キー作成のため一度からにする）  
    　　　 c.　変更前　DB_DATABASE=laravel_db　変更後　DB_DATABASE=demo_test  
    　　　　　d. 変更前 DB_USERNAME=laravel_user 変更後　　DB_USERNAME=root  
    　　　　 e.　変更前　DB_PASSWORD=laravel_pass　変更後　DB_PASSWORD=root  
   　　　　　・php artisan key:generate --env=testing  
  　　　　　 ・php artisan config:clear　　
  　　　　　 ・php artisan migrate --env=testing  
  　　　　　 ・src/phpunit.xmlを編集する  
    　　　　a. 変更前　<!-- <server name="DB_CONNECTION" value="sqlite"/> -->  
    　 　　　　  変更後　<server name="DB_CONNECTION" value="mysql_test"/>　  
    　　　 b. 変更前　<!-- <server name="DB_DATABASE" value=":memory:"/> -->  
   　　　　　    変更後 <server name="DB_DATABASE" value="demo_test"/>  
   　　　　　・基本的なテスト（値が正しいかどうか）のテストをする  
     　　　　　vendor/bin/phpunit tests/Feature/HelloTest.php  
   10  Storageにある画像をS3に移行  
         ・composer require aws/aws-sdk-php  
         ・composer require league/flysystem-aws-s3-v3 "^1.0"  
         ・php artisan make:command MigrateItemImagesToS3  
         ・php artisan make:command MigrateSoldItemImagesToS3  
         ・php artisan make:command MigrateProfileImagesToS3  
         ・php artisan migrate:itemImages-to-s3  
         ・php artisan migrate:soldItemImages-to-s3  
         ・php artisan migrate:profileImages-to-s3  

      

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
   2 AmazonLinux2にログインし、nginxのインストール・自動起動化  
     ・ターミナルで　.ssh/に移動しEC2インスタンスにsshでログインする  
     （ssh -i "coachtech-furima.pem" ec2-user@ec2-54-199-100-49.ap-northeast-1.compute.amazonaws.com）  
     ・sudo amazon-linux-extras enable nginx1  
     ・sudo yum -y install nginx  
     ・sudo systemctl enable nginx  
     ・sudo systemctl start nginx.service  
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
   13 git clone https://github.com/atsukonakazawa/20240528_atsukonakazawa_coachtech-furima.git  
   14 sudo yum install -y php-xml  
   15 cd 20240528_atsukonakazawa_coachtech-furima/src  
   16 composer update  
   17 composer install  
   18 cd ../../  
   19 sudo yum install php-devel php-opcache  
   20 cd 20240528_atsukonakazawa_coachtech-furima/src  
   21 cp .env.example .env  
   22 php artisan key:generate  
   23 .envを編集  
      ・FILESYSTEM_DRIVER=localを  
       FILESYSTEM_DRIVER=s3 に修正  
      ・DB_CONNECTION=mysql  
       DB_HOST=furima-database.cfwgskokkwmy.ap-northeast-1.rds.amazonaws.com  
       DB_PORT=3306  
       DB_DATABASE=FurimaDatabase  
       DB_USERNAME=admin  
       DB_PASSWORD=Furimafurima  
      ・MAIL_MAILER=smtp  
       MAIL_HOST=localhost  
       MAIL_PORT=1025  
       MAIL_USERNAME=null  
       MAIL_PASSWORD=null  
       MAIL_ENCRYPTION=null  
       MAIL_FROM_ADDRESS=coachtech-furima@example.com  
       MAIL_FROM_NAME="${APP_NAME}"  
      ・AWS_ACCESS_KEY_ID=AKIA6ODU4LEDH2UFMUFR  
       AWS_SECRET_ACCESS_KEY=fDDadGIY1mVyS+kO+2qht6UZyIDFuGjRMCfJkAo3  
       AWS_DEFAULT_REGION=ap-northeast-1  
       AWS_BUCKET=coachtech-furima-bucket  
       AWS_USE_PATH_STYLE_ENDPOINT=false  
      ・STRIPE_KEY=pk_test_51PBdN3IzbSIU1MHKVrPia3U5vPPiCmZsXye7h4EBpq1lwvdm3QEMWaeagHaPEvDagt5EZSETtzIqJMEuWKjnXTn90024rKvEpx  
       STRIPE_SECRET=sk_test_51PBdN3IzbSIU1MHK4NpwExQfpOQBtRpoPilzRXD0IWXMy9ejcY89jGzVl16pUOcF85lkkZXFRROtFJDoYERI3AjK00jSboz6Vn  
       CASHIER_CURRENCY=jpy  
    24 (srcに移動して）wget https://github.com/mailhog/MailHog/releases/download/v1.0.0/MailHog_linux_amd64  
    25 chmod +x MailHog_linux_amd64  
    26 sudo mv MailHog_linux_amd64 /usr/local/bin/mailhog  
    27 　※※※※【必須】※※※※メール機能利用のため、別ターミナルでAmazonLinuxw2にログイン後、「mailhog」というコマンドを実行しmaihogを起動したままにしておく！！！！！！！！！！！！！！！！※※※※※※※※※※※※※※※※※※※※※※ 　
    ２８ EC２のセキュリティグループのインバウンドルールを追加し、ポート番号８０２５からのアクセスを許可する  
    ２９ ブラウザでhttp://54.168.57.188:8025にアクセスしmailhogのインターフェイスが表示されることを確認  
    30 sudo yum install php-mbstring php-gd php-xml  
    31 sudo systemctl restart php-fpm  
    32 sudo systemctl restart nginx  
    33 composer require stripe/stripe-php  
    34 sudo yum install php-opcache  
    35 sudo systemctl start php-fpm.service  
    36 sudo systemctl enable php-fpm.service  
    37 sudo su -  
    38 cd /etc/php-fpm.d/  
    39 sudo cp www.conf www.conf_bk_yyyyMMdd  
    40 vim www.conf  
    41 www.confを以下の通り編集する  
       ・２４行目あたり  
        変更前 user = apache  
        変更後 user = nginx  
       ・26行目あたり  
        変更前 group = apache  
        変更後 group = nginx  
       ・48行目あたり  
        変更前 ;listen.owner = nobody  
        変更後 listen.owner = nginx  
       ・49行目あたり  
        変更前 ;listen.group = nobody  
        変更後 listen.group = nginx  
       ・50行目あたり  
        変更前　;listen.mode = 0660  
        変更後 listen.mode = 0660  
    42 vim /etc/nginx/nginx.conf  
    43 nginx.confを以下の通り編集する  
       ・変更前  
        server {  
        listen       80;  
        listen       [::]:80;  
        server_name  _;  
        root         /usr/share/nginx/html;  
       ・変更後  
        client_max_body_size 2M;  
        
        server {  
        listen       80;  
        listen       [::]:80;  
        server_name  _;  
        root         /var/www/20240528_atsukonakazawa_coachtech-furima/src/public;  
          
     add_header X-Frame-Options "SAMEORIGIN";  
     add_header X-Content-Type-Options "nosniff";  
        
     index index.php;  
        
     charset utf-8;  
        
     location / {  
         try_files $uri $uri/ /index.php?$query_string;  
     }  
        
     location ~ \.php$ {  
         fastcgi_pass   unix:/run/php-fpm/www.sock;  
         fastcgi_index  index.php;  
         fastcgi_param  SCRIPT_FILENAME  
         $document_root$fastcgi_script_name;  
         include        fastcgi_params;  
     }  
        
     location ~ /\.(?!well-known).* {  
         deny all;  
     }  
   44 sudo systemctl start nginx.service  
   45 sudo su -  
   46 cd /var/www/20240528_atsukonakazawa_coachtech-furima/src  
   47 php artisan migrate:fresh  
   48 cd database/seeders  
   49 vim DatabaseSeeder.php 
      ・コメントアウトを外しながら、 DatabaseSeeder.php 内に記載の通り、５回に分けてシードする  
      ・その際の流れは、DatabaseSeeder.phpの該当部分のコメントアウトを外す  
      →srcに戻ってからシード  
      →またdatabase/seedersに戻ってDatabaseSeeder.phpの次の該当部分のコメントアウトを外す‥  
      の工程の繰り返しとなる。  
   50 cd /var/www/20240528_atsukonakazawa_coachtech-furima/src  
   51 sudo chown -R nginx:nginx /var/www/20240528_atsukonakazawa_coachtech-furima/src/storage  
   52 sudo chown -R nginx:nginx /var/www/20240528_atsukonakazawa_coachtech-furima/src/bootstrap/cache  
   53 sudo systemctl restart nginx  
   54 php artisan storage:link  
   55 Elastic IPアドレスをec2インスタンスに関連付け  
   55 S3バケットの作成  
   56 composer require aws/aws-sdk-php  
   57 sudo su -  
   58 cd /var/www/20240528_atsukonakazawa_coachtech-furima  
   59 git pull origin main  
   60 再度 php artisan migrate:fresh  
   61 再度 php artisan db:seed  
      ・コメントアウトを外しながら、 DatabaseSeeder.php 内に記載の通り、５回に分けてシードする  
   62 composer update  
   63 composer require league/flysystem-aws-s3-v3  
   64 php.iniに以下の内容を追加  
      post_max_size = 2M  
      upload_max_filesize = 2M  


    
    

   
