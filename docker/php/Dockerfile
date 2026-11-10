FROM php:8.4-fpm

ARG UID=1000
ARG GID=1000

# Dependências do sistema + extensões PHP que o Laravel usa
RUN apt-get update && apt-get install -y \
        git unzip libzip-dev libpng-dev libicu-dev \
    && docker-php-ext-install pdo_mysql zip bcmath intl pcntl exif gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer copiado da imagem oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Usuário com o mesmo UID/GID do seu usuário local (evita problema de permissão)
RUN groupadd -g ${GID} app \
    && useradd -u ${UID} -g app -m -s /bin/bash app \
    && sed -i 's/^user = /;user = /; s/^group = /;group = /' /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/html
USER app

EXPOSE 9000
CMD ["php-fpm"]