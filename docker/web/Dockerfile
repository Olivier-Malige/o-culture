FROM node:20-bookworm AS build

WORKDIR /app

ENV NODE_OPTIONS=--openssl-legacy-provider

COPY client/package.json client/yarn.lock ./
RUN yarn install --frozen-lockfile

COPY client/ ./
ARG API_URL=
ENV API_URL=$API_URL
RUN yarn build:prod

FROM caddy:2-alpine

COPY docker/caddy/Caddyfile /etc/caddy/Caddyfile
COPY --from=build /app/dist /srv
