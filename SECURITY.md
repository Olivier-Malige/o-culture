# Security policy

O'Culture is a **historical training project** (O'Clock, 2018). Its runtime
(PHP 7.4, Symfony 4.2, React 16) is end-of-life and **not security-supported**.

## What to report

Please open an issue if this repository still contains:

- private keys, passwords, or live secrets
- personal data that should not be public

Do not expect patches for known CVEs in Symfony 4.2, PHP 7.4, or the 2018
JavaScript toolchain. Run the app only in Docker (or an equivalent isolated
environment). Isolation is the mitigation, not a full security audit.

## Production

If you deploy this demo, generate new `APP_SECRET` and `JWT_PASSPHRASE` values,
keep JWT keys out of git, and put TLS in front of the stack (Caddy in
`docker-compose.prod.yml`).
