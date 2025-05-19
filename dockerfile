# Menggunakan image dasar
FROM php:8.1-fpm

# Instal dependensi sistem
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git

# Mengatur direktori kerja
WORKDIR /var/www

# Mengkopi file aplikasi ke container
COPY . .

# Menginstal Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Menginstal dependensi PHP
RUN composer install

# Menjalankan perintah untuk expose port atau mengatur entrypoint
CMD ["php-fpm"]
