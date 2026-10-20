FROM php:8.1-apache

# 1. Install necessary extensions for Aiven MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 2. Enable Apache rewrite rules (required for GD private servers)
RUN a2enmod rewrite

# 3. FIX: Stop the MPM crash by replacing the dynamic include block with a hardcoded prefork load statement
RUN sed -i 's|IncludeOptional mods-enabled/\*.load|# IncludeOptional mods-enabled/*.load\nInclude mods-enabled/mpm_prefork.load\nInclude mods-enabled/authz_core.load\nInclude mods-enabled/dir.load\nInclude mods-enabled/mime.load\nInclude mods-enabled/php.load\nInclude mods-enabled/rewrite.load|' /etc/apache2/apache2.conf \
    && sed -i 's|IncludeOptional mods-enabled/\*.conf|# IncludeOptional mods-enabled/*.conf\nInclude mods-enabled/dir.conf\nInclude mods-enabled/mime.conf\nInclude mods-enabled/php.conf|' /etc/apache2/apache2.conf

# 4. Force Apache to prioritize index.php over directory loops
RUN echo "DirectoryIndex index.php index.html" > /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php

# 5. Copy everything from your db/ folder straight into the web root
COPY db/ /var/www/html/

EXPOSE 80
