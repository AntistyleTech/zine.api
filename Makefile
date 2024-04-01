env=local
container=app
proxy_network=reverse-proxy

uid=1000
gid=1000

.PHONY: install composer-install npm-install artisan-migrate artisan-migrate rebuild

install: build up composer-install-all npm-install artisan-migrate restart

composer-install:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) composer install

composer-install-all:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) app composer install
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) schedule composer install
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) queue composer install

composer-update:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) composer update

composer-update-all:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) app composer update
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) schedule composer update
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) queue composer update

# Only for chokidar Swoole required
npm-install:
	@docker compose -f compose.$(env).yaml exec --user root $(container) npm install

artisan-migrate:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) php artisan migrate

rebuild:
	@docker compose -f compose.$(env).yaml up -d --build --force-recreate


.PHONY: up down restart build exec run

up:
	@docker compose -f compose.$(env).yaml up -d

down:
	@docker compose -f compose.$(env).yaml down

restart:
	@docker compose -f compose.$(env).yaml restart

build:
	@docker compose -f compose.$(env).yaml build

exec:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) bash

run:
	@docker compose -f compose.$(env).yaml run --user $(uid):$(gid) $(container) bash


.PHONY: network-create

network-create:
	@docker network create --driver bridge $(proxy_network) || true