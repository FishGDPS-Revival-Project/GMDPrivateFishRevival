FROM php:8.1-apache

# 1. Install necessary extensions for Aiven MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 2. Enable Apache rewrite rules (required for GD private servers)
RUN a2enmod rewrite

# 3. Force Apache to prioritize index.php over directory loops
RUN echo "DirectoryIndex index.php index.html" > /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php

# 4. Copy everything from your db/ folder straight into the web root
COPY db/ /var/www/html/

# 5. FIX: Clean conflicting MPM links AND explicitly tell Apache to process PHP files before starting
CMD bash -c "rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.*; echo '<FilesMatch \.php$> \nSetHandler application/x-httpd-php \n</FilesMatch>' > /etc/apache2/conf-available/docker-php-handler.conf && a2enconf docker-php-handler; apache2-foreground"

EXPOSE 80
