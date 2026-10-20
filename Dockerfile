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

# 5. FIX: Force-delete ALL conflicting MPM links right before Apache runs at boot time
CMD bash -c "rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.*; apache2-foreground"

EXPOSE 80
