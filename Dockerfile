FROM php:7.4-apache

WORKDIR /var/www/html/

RUN apt-get update
RUN apt-get -y --no-install-recommends install gnupg2 software-properties-common

RUN curl -sSL https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN apt-add-repository https://packages.microsoft.com/debian/10/prod

RUN apt-get update

RUN apt-get -y --no-install-recommends install unixodbc-dev \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools
RUN docker-php-ext-install pdo
RUN pecl install sqlsrv pdo_sqlsrv xdebug
RUN docker-php-ext-enable sqlsrv pdo_sqlsrv xdebug
