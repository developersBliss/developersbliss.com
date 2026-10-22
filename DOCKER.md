# Docker deployment

This repository owns its Dockerfile and Compose project. Build and deploy with an
external env file defining `CADDY_IMAGE` (an exact digest) and `APP_VOLUME` where
applicable. `DEVELOPERSBLISS_BUILD_CONTEXT` optionally selects this Git repository
at an exact commit instead of the local checkout.

Create Docker network `apps-developersbliss-frontend`, then run:

```sh
docker compose --env-file /path/to/deployment.env build
docker compose --env-file /path/to/deployment.env up -d --wait
```

The container serves port 8080 only on its Docker frontend network. A separate
proxy handles public HTTPS. The site runs without root privileges or Linux
capabilities, with a read-only filesystem and a 64 MiB memory limit. No application
database or mutable volume is required.
