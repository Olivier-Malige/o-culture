# O'Culture

Application de formation (O'Clock, 2018) : événements culturels, artistes et
lieux. Stack mise à jour pour un hébergement Docker : **PHP 8.3 / Symfony 6.4 /
React 16**.

Ce n’est **pas** un produit officiel O'Clock. Générez des secrets uniques avant
toute exposition sur Internet.

Licence : [MIT](LICENSE).

## Prérequis

- Docker Compose v2

## Démarrage local

```bash
cp .env.example .env
docker compose up --build
```

- Front live (hot reload) : [http://localhost:3000](http://localhost:3000)
- Stack « buildée » + admin : [http://localhost:8080](http://localhost:8080)
  (Caddy sert le build figé : pas de hot reload sur ce port)

Modifier `client/src` suffit : pas besoin de rebuild Docker. Rebuild `front`
uniquement si `client/package.json` / `yarn.lock` changent.

L’API passe par le proxy Webpack (même origine). MariaDB n’est pas publiée
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
au domaine. Changez `DEMO_PASSWORD`.

4. Lancez :

```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml --env-file .env.prod up -d --build
```

Caddy obtient un certificat Let's Encrypt. Les clés JWT sont générées au
premier démarrage (volume Docker, hors git).

### Renouvellement des événements de démonstration

Après avoir déployé cette version, lancez une première fois la commande pour
remplir la démo avec 30 événements à venir :

```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml --env-file .env.prod exec -T api \
  php bin/console app:demo:refresh-events --env=prod --no-debug
```

La commande supprime les événements dont la date est passée, puis complète le
calendrier jusqu’à 30 événements actifs à venir. Les commentaires associés aux
événements supprimés le sont aussi; les événements futurs restent intacts.
Pour la lancer automatiquement le premier jour de chaque mois à 03:15, ajoutez
cette ligne au crontab de l’utilisateur qui peut exécuter Docker (`crontab -e`) :

```cron
15 3 1 * * /home/ubuntu/o-culture/docker/refresh-demo-events.sh >> /home/ubuntu/o-culture/demo-events.log 2>&1
```

Adaptez `/home/ubuntu/o-culture` si le dépôt se trouve ailleurs. Le script
utilise `.env.prod` et exécute la commande dans le conteneur API déjà lancé.

## Architecture

- `web` : Caddy (SPA + reverse-proxy `/api`, `/admin`, `/chat`)
- `api` : Apache + PHP 8.3 (Symfony 6.4)
- `db` : MariaDB 10.11 + seed anonymisé

## Front sans Docker

Si Node 20 et Yarn sont installés sur l’hôte, avec l’API déjà lancée :

```bash
cd client && yarn start
```

Webpack écoute sur [http://localhost:3000](http://localhost:3000) et proxy
`/api` vers [http://localhost:8080](http://localhost:8080).
