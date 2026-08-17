# O'Culture

Application de formation (O'Clock, 2018) : événements culturels, artistes et
lieux. Stack figée volontairement — **PHP 7.4 / Symfony 4.2 / React 16** — pour
pouvoir la relancer telle quelle.

Ce n’est **pas** un produit officiel O'Clock. Les dépendances sont en fin de
vie : utilisez Docker, ne l’exposez pas comme un service critique.

Licence : [MIT](LICENSE).

## Prérequis

- Docker Compose v2

## Démarrage local

```bash
cp .env.example .env
docker compose up --build
```

Ouvrir [http://localhost:8080](http://localhost:8080).

Le front et l’API passent par Caddy (même origine). MariaDB n’est pas publiée
sur l’hôte.

## Comptes de démo

Mot de passe : `oculture`

| Rôle | Email |
|------|-------|
| Admin (back-office) | `admin@example.com` |
| Modérateur | `moderator@example.com` |
| Utilisateur | `user@example.com` |
| Artiste | `artist@example.com` |
| Organisateur | `organizer@example.com` |

Back-office Twig : [http://localhost:8080/admin/login](http://localhost:8080/admin/login).

Les autres comptes du seed utilisent le même mot de passe.

## Production (VPS)

1. Pointez le DNS (`A` / `AAAA`) vers le serveur.
2. Ouvrez les ports **80** et **443**.
3. Copiez et renseignez l’environnement :

```bash
cp .env.prod.example .env.prod
```

Renseignez au minimum `DOMAIN`, `ACME_EMAIL`, `APP_SECRET`, `JWT_PASSPHRASE`
et les mots de passe MariaDB. Adaptez `TRUSTED_HOSTS` et `CORS_ALLOW_ORIGIN`
au domaine.

4. Lancez :

```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml --env-file .env.prod up -d --build
```

Caddy obtient un certificat Let's Encrypt. Les clés JWT sont générées au
premier démarrage (volume Docker, hors git).

## Architecture

- `web` : Caddy (SPA + reverse-proxy `/api`, `/admin`, `/chat`)
- `api` : Apache + PHP 7.4 (Symfony)
- `db` : MariaDB 10.11 + seed anonymisé

## Développement hors Docker

Possible mais déconseillé (PHP 7.4 et Node 10–14). Les fichiers
`server/.env.dist` et `client/package.json` documentent l’ancienne procédure
(`composer install`, `yarn start`). L’URL d’API se configure avec `API_URL`
au build Webpack (vide = same-origin).
