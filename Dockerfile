ARG CADDY_IMAGE=caddy:2-alpine
FROM ${CADDY_IMAGE}
RUN setcap -r /usr/bin/caddy
COPY docker/Caddyfile /etc/caddy/Caddyfile
COPY . /srv/site/
EXPOSE 8080
