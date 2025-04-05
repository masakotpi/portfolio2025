# ベースイメージ（PHP + Composer）
FROM php:8.2-fpm

# システム依存パッケージのインストール
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    nginx \
    supervisor \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer のインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの設定
WORKDIR /var/www

# Laravel アプリケーションのソースをコピー
COPY . /var/www

# 権限の設定
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Nginx 設定を追加
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Supervisor 設定
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Laravel の依存パッケージインストール
RUN composer install --no-dev --optimize-autoloader

# Laravel の設定系
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# ポート開放
EXPOSE 80

# Supervisor 経由で Nginx + PHP を起動
CMD ["/usr/bin/supervisord"]
