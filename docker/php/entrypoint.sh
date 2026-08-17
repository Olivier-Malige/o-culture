#!/bin/sh
set -eu

JWT_DIR=/var/www/html/config/jwt
mkdir -p "$JWT_DIR"

if [ ! -f "$JWT_DIR/private.pem" ] || [ ! -f "$JWT_DIR/public.pem" ]; then
  echo "Generating JWT key pair"
  openssl genrsa -out "$JWT_DIR/private.pem" -aes256 -passout pass:"$JWT_PASSPHRASE" 2048
  openssl rsa -pubout -in "$JWT_DIR/private.pem" -out "$JWT_DIR/public.pem" -passin pass:"$JWT_PASSPHRASE"
fi

php /usr/local/bin/reset-demo-passwords.php

mkdir -p var/cache var/log
php bin/console cache:clear --env="${APP_ENV:-prod}" --no-debug --no-interaction
chown -R www-data:www-data var "$JWT_DIR"

exec apache2-foreground
