FROM php:8.2-apache

# Install required PHP extensions for CodeIgniter 4 & MySQL
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install intl pdo pdo_mysql mysqli zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache Document Root to /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2-conf.d/*.conf 2>/dev/null || true

# Copy project files
COPY . /var/www/html/

# Create uploads and writable directories with full write permissions
RUN mkdir -p /var/www/html/public/uploads /var/www/html/writable \
    && chown -R www-data:www-data /var/www/html/public/uploads /var/www/html/writable \
    && chmod -R 777 /var/www/html/public/uploads /var/www/html/writable

EXPOSE 80
CMD ["apache2-foreground"]
