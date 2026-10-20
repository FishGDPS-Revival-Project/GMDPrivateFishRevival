FROM php:8.1-apache

# 1. Force-disable the conflicting event MPM and enable prefork
RUN a2dismod mpm_event || true && a2enmod mpm_prefork

# 2. Install necessary extensions for Aiven MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 3. Enable Apache rewrite rules (required for GD private servers)
RUN a2enmod rewrite

# 4. Force Apache to prioritize index.php over directory loops
RUN echo "DirectoryIndex index.php index.html" > /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php

# 5. Copy everything from your db/ folder straight into the web root
COPY db/ /var/www/html/

EXPOSE 80
