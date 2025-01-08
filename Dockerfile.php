FROM stephen359595/laravel-php:7.3

WORKDIR /var/www/html

COPY ./volume/web /var/www/html
COPY ./laravel-container/php/php.ini /usr/local/etc/php/conf.d/laravel.ini

# 確保 storage 目錄具有適當的權限
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 設置執行時權限，避免後續 Laravel 記錄無法寫入
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer install --no-dev --optimize-autoloader
RUN php artisan config:clear
RUN php artisan key:generate