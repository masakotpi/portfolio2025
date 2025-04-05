FROM php:8.1-fpm

# 必要なパッケージや拡張のインストール
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Composer のインストール（公式イメージからコピー）
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの設定
WORKDIR /var/www

# アプリケーションのファイルをコピー
COPY . /var/www

# Composer の依存関係インストール
RUN composer install --no-dev --optimize-autoloader

# キャッシュの生成（オプション）
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# コンテナ起動時に PHP-FPM を実行
CMD ["php-fpm"]
