## Product Manager Ver1


# Docker コンテナビルド
- ` [mac] $ docker compose up -d --build`

- ` [mac] $ docker compose exec app bash`
- ` [#work] $ composer install`
- ` [#work] $ cp .env.example .env`
- ` [#work] $ php artisan key:generate`
- ` [#work] $ php artisan storage:link`
- ` [#work] $ chmod -R 777 storage bootstrap/cache`
-  Database.sqliiteをdatabase配下に作る。
- ` [#work] $ php artisan migrate`
- ` [#work] $ composer require laravelcollective/html`
- http://127.0.0.1:8081/


## MYSQL接続
- ` [laravel] $ docker-compose exec db bash`
- ` [db] $ mysql -u $MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE`
- ` [db] $ SHOW databases;`
- ` [db] $ USE laravel_local;`
- ` [db] $ SELECT database();`

## Docker環境の破棄
コンテナの停止、ネットワーク・名前付きボリューム・コンテナイメージ、未定義コンテナを削除
- ` [mac] $ docker-compose down --rmi all --volumes --remove-orphans`


## 作業ディレクトリの削除
- ` [mac] $ cd ..`
- ` [mac] $ rm -rf xxxxxxx`

## Larastan
- ` vendor/bin/phpstan analyse app`

