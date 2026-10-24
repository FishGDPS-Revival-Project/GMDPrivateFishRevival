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

# 3. Copy your clean server files directly into the web root folder
COPY db/ /var/www/html/

# 4. Create an internal startup script to force boot BOTH FPM and Nginx smoothly
RUN echo '#!/bin/sh\nphp-fpm -D\nexec nginx -g "daemon off;"' > /entrypoint.sh \
    && chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
