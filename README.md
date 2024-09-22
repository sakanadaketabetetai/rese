# Rese(飲食店予約システム)

## 概要

このプロジェクトは、飲食店へ予約することができるアプリケーションです。ユーザーは会員登録後、飲食店へ予約又は会食後の決済、飲食店代表者は予約情報の管理、QRコードで予約情報の参照などを容易に行うことができます。

## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## アプリケーションURL
- AtteのURL : http://57.180.64.63/
- MailCatcherのURL : http://57.180.64.63:1080

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
- 飲食店の予約が可能、
- 休憩時間の追跡
- 日別の出勤データのフィルタリング
- ユーザーフレンドリーなインターフェース

## テーブル設計
###rese table図
![rese_table](https://github.com/user-attachments/assets/06ea522e-53ea-4a97-a6bc-2913d48805fa)
###laravel_permission table図
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


1. ログインしてダッシュボードにアクセスします。

2. 「勤務開始」をクリックして、勤務を開始します。

3. 「勤務終了」をクリックして、勤務を終了します。

4. 「休憩開始」をクリックして、休憩を開始します。

5. 「休憩終了」をクリックして、休憩を終了します。

6. 「日付一覧」をクリックすると、日付別の勤怠情報を閲覧できます。

7. 「ユーザー一覧」をクリックすると、ユーザー一覧ページに移動し、ユーザーごと
　　 の勤怠情報を閲覧できます。

8.  会員登録する場合は、「氏名」、「メールアドレス」、「パスワード」を入力し
　  入力したメールアドレスに確認メールが送信されます。

