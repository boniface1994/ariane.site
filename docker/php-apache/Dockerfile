FROM php:7.3-apache
RUN apt-get update -qq && \
    apt-get install -qy \
    supervisor \
    wget \
    zip \
    libzip-dev \
    unzip \
    libicu-dev \
    libedit-dev \
    libfcgi0ldbl \
    libfreetype6-dev \
    libicu-dev \
    libpng-dev \
    libpq-dev \
    libxpm-dev \
    locales \
    gnupg2 \
    git-core \
    openssh-server \
    fonts-powerline \
    zsh \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql intl opcache json readline gd zip \
    && apt-get upgrade -y

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Laravel

#Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_15.x | bash - && \
    apt-get install -y nodejs

#SSH configuration
RUN apt-get update && apt-get install gnupg2 -y

#Install oh-my-zsh
RUN wget https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh -O - | zsh
RUN git clone --depth=1 https://github.com/romkatv/powerlevel10k.git ${ZSH_CUSTOM:-$HOME/.oh-my-zsh/custom}/themes/powerlevel10k
COPY .p10k.zsh /root/.p10k.zsh
COPY .zshrc /root/.zshrc

# RUN chown -R www-data:www-data /var/www
RUN a2enmod rewrite