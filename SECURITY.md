# Security policy

O'Culture is a **training project** (O'Clock, 2018) brought up to a
maintainable runtime (PHP 8.3, Symfony 6.4 LTS). It is still a demo: treat
exposed instances as non-critical.

## What to report

Please open an issue if this repository still contains:

- private keys, passwords, or live secrets
- personal data that should not be public

## Production

If you deploy this demo:

- generate new `APP_SECRET` and `JWT_PASSPHRASE` values
- use strong MariaDB passwords (never keep the compose defaults)
- keep JWT keys out of git (Docker volume)
- put TLS in front of the stack (`docker-compose.prod.yml`)
- set `TRUSTED_HOSTS` and `CORS_ALLOW_ORIGIN` to your domain
- change `DEMO_PASSWORD` (seed accounts are reset on each API boot)
