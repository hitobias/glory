FROM wordpress:6.7-php8.2-apache

# Install WP-CLI with integrity verification
RUN curl -fSL -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && echo "be928f6b8ca1e8dfb9d2f4b75a13aa4aee0896f8a9a0a1c45cd5d2c98605e6172e6d014dda2e27f88c98befc16c040cbb2bd1bfa121510ea5cdf5f6a30fe8832  /usr/local/bin/wp" | sha512sum -c - \
    && chmod +x /usr/local/bin/wp

# PHP configuration
RUN { \
    echo 'memory_limit = 256M'; \
    echo 'upload_max_filesize = 64M'; \
    echo 'post_max_size = 64M'; \
    echo 'max_execution_time = 300'; \
    echo 'max_input_vars = 3000'; \
    echo 'date.timezone = Asia/Taipei'; \
} > /usr/local/etc/php/conf.d/glory-custom.ini

# Install additional PHP extensions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# OPcache configuration
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
} > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Enable Apache mod_rewrite and mod_headers
RUN a2enmod rewrite headers

# Configure sendmail for Mailhog
RUN { \
    echo 'sendmail_path = "/usr/sbin/sendmail -t -i -S mailhog:1025"'; \
} > /usr/local/etc/php/conf.d/mailhog.ini
