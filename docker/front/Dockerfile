FROM node:20-bookworm

WORKDIR /app

ENV NODE_OPTIONS=--openssl-legacy-provider

COPY client/package.json client/yarn.lock ./
RUN yarn install --frozen-lockfile

EXPOSE 3000

CMD ["yarn", "start"]
