# ベースイメージ（PHP + Composer インストール済み）
FROM php:8.2-fpm

# 必要なシステムパッケージをインストール
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    nginx \
    supervisor \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer を公式からインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 作業ディレクトリ
WORKDIR /var/www

# アプリケーションコードをコピー
COPY . /var/www

# パーミッション設定
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Nginx 設定
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Supervisor 設定
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Laravel パッケージインストール
RUN composer install --no-dev --optimize-autoloader

# Laravel キャッシュ系
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# ポート公開
EXPOSE 80

# 起動コマンド（nginx + php-fpm）
CMD ["/usr/bin/supervisord"]
