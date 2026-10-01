#!/bin/sh
set -eu

cd "$(dirname "$0")/.."

docker compose \
  -f docker-compose.yml \
  -f docker-compose.prod.yml \
  --env-file .env.prod \
  exec -T api php bin/console app:demo:refresh-events --env=prod --no-debug
