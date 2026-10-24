FROM php:8.1-fpm

# 1. Install Nginx and required dependencies for Aiven MySQL
RUN apt-get update && apt-get install -y nginx \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure Nginx to cleanly route game requests to PHP-FPM over Port 80
RUN echo 'server { \
    listen 80 default_server; \
    root /var/www/html; \
    index index.php index.html; \
    charset utf-8; \
    location / { \
        try_files $uri $uri/ /index.php?$query_string; \
    } \
    location ~ \.php$ { \
        include fastcgi_params; \
        fastcgi_pass 127.0.0.1:9000; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
    } \
}' > /etc/nginx/sites-available/default

# 3. FIX: Force Nginx to run directly as root and fix temporary folder permissions
RUN sed -i 's/user www-data;/user root;/' /etc/nginx/nginx.conf \
    && chown -R root:root /var/lib/nginx /var/log/nginx

# 4. Copy your clean server files directly into the web root folder
COPY db/ /var/www/html/

# 5. FIX: Force PHP-FPM to allow running as root without user switching
RUN echo "user = root\ngroup = root" >> /usr/local/etc/php-fpm.d/www.conf

# 6. Create an internal startup script to force boot BOTH FPM (as root) and Nginx smoothly
RUN echo '#!/bin/sh\nphp-fpm -R -D\nexec nginx -g "daemon off;"' > /entrypoint.sh \
    && chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
