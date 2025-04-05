# ベースイメージ（PHP + Apache + Composer）
FROM php:8.2-apache

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev zip nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Composer インストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ApacheのDocumentRootをLaravelのpublicに設定
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Laravel アプリケーションをコピー
COPY . /var/www/html

WORKDIR /var/www/html

# Laravel の依存関係をインストール
RUN composer install --no-dev --optimize-autoloader

# Laravel のフロントエンド（Vite）ビルド
RUN npm install && npm run build

# Laravel 初期セットアップ
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# 権限を調整
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Apache 起動
EXPOSE 80
CMD ["apache2-foreground"]
