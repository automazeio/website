FROM alpine:3.21

# Setup document root
WORKDIR /var/www/html

# Install packages and remove default server definition
RUN apk add --no-cache \
  libmemcached-dev \
  memcached \
  curl \
  bash \
  nano \
  nginx \
  dcron \
  php84 \
  php84-bcmath \
  php84-bz2 \
  php84-cgi \
  php84-cli \
  php84-common \
  php84-ctype \
  php84-curl \
  php84-dba \
  php84-dev \
  php84-dom \
  php84-enchant \
  php84-fpm \
  php84-fileinfo \
  php84-gd \
  php84-gmp \
  php84-imap \
  php84-intl \
  php84-ldap \
  php84-mbstring \
  php84-mysqli \
  php84-odbc \
  php84-opcache \
  php84-openssl \
  php84-pdo \
  php84-pdo_mysql \
  php84-pgsql \
  php84-phar \
  php84-phpdbg \
  php84-session \
  php84-snmp \
  php84-soap \
  php84-sqlite3 \
  php84-tidy \
  php84-xml \
  php84-simplexml \
  php84-xmlreader \
  php84-xsl \
  php84-zip \
  php84-pecl-memcached \
  php84-pecl-imagick \
  php84-pecl-apcu \
  php84-pecl-excimer \
  supervisor \
  imagemagick \
  imagemagick-dev

# Configure nginx - http
COPY server-config/nginx.conf /etc/nginx/nginx.conf

# Configure default server
COPY server-config/conf.d /etc/nginx/conf.d/

# Configure PHP-FPM
COPY server-config/fpm-www.conf /etc/php84/php-fpm.d/www.conf
COPY server-config/php.ini /etc/php84/conf.d/custom.ini
RUN ln -s /usr/bin/php84 /usr/bin/php

# Configure supervisord
COPY server-config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN chmod +x /etc/supervisor/conf.d/supervisord.conf

# Configure timezone
RUN apk add --no-cache tzdata && \
    cp /usr/share/zoneinfo/UTC /etc/localtime && \
    echo "UTC" > /etc/timezone && \
    apk del tzdata

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add application
COPY html /var/www/html
COPY tiny /var/www/tiny
COPY app /var/www/app
COPY .version /var/www
COPY composer.json /var/www
RUN find /var/www -name ".DS_Store" -type f -delete
RUN chmod +x /var/www/app/scheduler.sh

# Create log directories and set up cron
RUN mkdir -p /var/log/cron && \
    touch /var/log/cron/cron.log /var/log/cron/cron.error.log && \
    chown -R nobody:nobody /var/log/cron

# Create error pages directory with proper permissions
RUN mkdir -p /var/lib/nginx/html && \
    echo "<html><body><h1>Error 50x</h1><p>An internal server error occurred.</p></body></html>" > /var/lib/nginx/html/50x.html && \
    echo "<html><body><h1>Error 404</h1><p>Page not found.</p></body></html>" > /var/lib/nginx/html/404.html && \
    chown -R nginx:nginx /var/lib/nginx/html && \
    chmod -R 755 /var/lib/nginx/html

# Setup crontab
COPY server-config/crontab.txt /etc/crontabs/root
RUN chmod 600 /etc/crontabs/root

# Set all permissions
RUN chown -R nobody:nginx /var/www /run /var/lib/nginx /var/log/nginx /etc/nginx /etc/php84 && \
    chmod 755 /run && \
    chmod -R 755 /var/www/html && \
    chmod -R 755 /var/log/nginx && \
    chmod -R 755 /var/lib/nginx && \
    chmod 755 /etc/php84/php-fpm.d/www.conf && \
    mkdir -p /var/log/php && \
    touch /var/log/php/php-errors.log && \
    chmod 777 /var/log/php/php-errors.log

# Install dependencies
RUN composer install --working-dir=/var/www --no-dev --ignore-platform-reqs --optimize-autoloader --no-cache

# Expose the port nginx is reachable on
EXPOSE 8080

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
