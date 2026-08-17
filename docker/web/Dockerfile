FROM node:14-bullseye AS build

WORKDIR /app

COPY client/package.json client/yarn.lock ./
RUN yarn install

COPY client/ ./
ARG API_URL=
ENV API_URL=$API_URL
RUN yarn build:prod

FROM caddy:2-alpine

COPY docker/caddy/Caddyfile /etc/caddy/Caddyfile
COPY --from=build /app/dist /srv
