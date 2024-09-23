# Rese(飲食店予約システム)

## 概要

このプロジェクトは、飲食店へ予約することができるアプリケーションです。ユーザーは会員登録後、飲食店へ予約又は会食後の決済、飲食店代表者は予約情報の管理、QRコードで予約情報の参照などを容易に行うことができます。

## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## アプリケーションURL
- ReseのURL : http://localhost  
  ※awsデプロイした場合は、http://AWSパブリックIPv4アドレス
- MailCatcherのURL : http://localhost:1080    
  ※awsデプロイした場合、http://AWSパブリックIPv4アドレス:1080
### 参考URL(awsにデプロイ)
- ReseのURL : http://13.114.104.147
- MailCatcherのURL : http://13.114.104.147:1080

## GitHubのリポジトリ
- https://github.com/sakanadaketabetetai/rese.git
　

## 機能一覧
### 全権限に共通する機能
- 会員登録機能 ( メール認証付 )
- ログイン及びログアウト機能
- ユーザー情報、ユーザー飲食店予約情報取得
- 飲食店一覧及び詳細情報取得
- 飲食店お気に入り登録機能
- 飲食店検索機能（エリア、ジャンル、店名で検索可能）
### 管理者権限機能
- 登録しているユーザー情報一覧（削除及び権限変更、アナウンスメール機能付き）
- 登録している飲食店の詳細情報一覧機能
- 飲食店代表者の追加機能
- 飲食店一覧及び詳細情報取得
### 飲食店代表者権限機能
- 代表者自身が登録している店舗情報一覧（店舗情報内容変更機能付き）
- 予約情報一覧機能（会計金額入力機能付）
- 飲食店登録機能

## 使用技術 ( 実行環境 )
- Docker 26.1.4
- Laravel 8.x
- php 7.4.9-fpm
- mysql 8.0.26
- mailcatcher ( メール認証機能確認用 )

## 特徴
- 飲食店の予約や決済が可能
- 店舗代表者は予約や店舗情報の管理が可能
- 店舗代表者はお客様来店時にQRコードで予約情報の確認や来店手続きが可能
- 登録している店舗情報をジャンルやエリア、店名で検索が可能
- 管理者はユーザー情報及び店舗情報等の管理（権限変更や店舗代表者の追加等）が可能
- ユーザーフレンドリーなインターフェース

## テーブル設計
### rese table図
![rese_table](https://github.com/user-attachments/assets/f60c1b1f-7da0-41d9-8cb1-0b3b59f29f69)
### laravel_permission table図
![laravel_permission_table](https://github.com/user-attachments/assets/b63996ad-be02-4351-a1db-3df76a350579)

## ER図
### rese er図
![rese](https://github.com/user-attachments/assets/853e169a-0e74-4885-b690-08dc461b74b8)
### laravel_permission er図 (laravel Permissionパッケージ)
![laravel_permission](https://github.com/user-attachments/assets/1bc4c69c-6f57-46b9-b784-0edd494ddef3)

## 環境構築

### Dockerビルド

1. ```bash 
   git clone git@github.com:sakanadaketabetetai/rese.git
   ```
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build


### Laravel環境構築

1. PHPコンテナにアクセス:
    ```bash
    docker-compose exec php bash
    ```
2. 依存関係をインストールします:
    ```bash
    composer install
    ```
3. 環境変数ファイルをコピーします:
    ```bash
    cp .env.example .env
    ```
4. .envに以下の環境変数を追加
    Mysqlに関する設定
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass
    ```
    メールに関する設定
    ※下の変数設定はMailCatcherを使用する場合の設定であり、自身のメールアドレスを使用する場合は、必要に応じて設定値を変更する
    ```bash
    MAIL_MAILER=smtp
    MAIL_HOST=mailcatcher  //自身のメールサーバーを入力 
    MAIL_PORT=1025 //使用するポートを入力
    MAIL_USERNAME=null //自身のメールアドレス
    MAIL_PASSWORD=null //自身のメールサーバーにアクセスするパスワード
    MAIL_ENCRYPTION=null //ssl
    MAIL_FROM_ADDRESS=no-reply@example.com //自身のメールアドレス
    MAIL_FROM_NAME="${APP_NAME}"
    ```
    APP環境
    ```bash
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=　     //php artisan key:generate実行時に自動で生成される
    APP_DEBUG=true
    APP_URL=http://localhost //AWS ec2インスタンスにデプロイする場合、AWSパブリックIPv4アドレスを入力
    ```
    
5. アプリケーションキーを生成します:
    ```bash
    php artisan key:generate
    ```
6. マイグレーションを実行します:
    ```bash
    php artisan migrate
    ```
7. シーディングを実行
    ```bash
    php artisan db:seed  
    ```
    //準備しているMasterDatabaseSeeder.phpとStoreSeeder.phpの内容がデータベースに保存される


## 基本的な使い方

### 全権限共通
1. ログインしてダッシュボードにアクセスします。

2. 予約したい飲食店カード内の「詳しく見る」をクリックして、
　 店舗詳細画面を表示すると、レビューができ、また予約が可能です。

3. 予約したい飲食店カード内の「♥」をクリックすると、お気に入りに登録
   されます。再度クリックすると、解除されます。

4. 左上のアイコンをクリックするとメニュー画面が表示され、「Mypage」を
　 クリックすると、マイページ画面が表示され、予約状況やお気に入り
　 店舗が確認できます。ここで予約内容の変更やQRコード表示、決済が可能です。

5. 会員登録する場合は、「氏名」、「メールアドレス」、「パスワード」を
　 入力し入力したメールアドレスに確認メールが送信されます。

6. 予約前日にリマインドメールが送信されます。

### 管理者権限
1. 左上のアイコンをクリックするとメニュー画面が表示され、「Admin」を
　 クリックすると、管理者画面が表示され、ユーザー情報や店舗情報等の確認が
　 できます。アナウンスメール送信や店舗代表者を追加することができます。

### 店舗代表者権限
1. 左上のアイコンをクリックするとメニュー画面が表示され「Store_Owner
　 _Admin」をクリックすると、店舗代表者管理画面が表示され、予約情報や店舗
　 情報等の確認や編集ができます。また店舗情報を追加することができます。



