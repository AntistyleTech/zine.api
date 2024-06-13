env=local
container=app
proxy_network=reverse-proxy

uid=1000
gid=1000

.PHONY: install npm-install artisan-migrate artisan-migrate-fresh rebuild

install: up npm-install composer-install artisan-migrate restart

# Only for chokidar
# Required for octane --watch option
npm-install:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) npm install

composer-install:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) composer install

composer-update:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) composer update

artisan-migrate:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) php artisan migrate

artisan-migrate-fresh:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) php artisan migrate:fresh

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


.PHONY: up-all down-all

up-all:
	@cd ../zine.proxy && make up
	@cd ../zine.api && make up
	@cd ../zine.web && make up

down-all:
	@cd ../zine.proxy && make down
	@cd ../zine.api && make down
	@cd ../zine.web && make down


.PHONY: network-create

network-create:
	@docker network create --driver bridge $(proxy_network) || true


.PHONY: octane-start octane-stop octane-reload

octane-start:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) php artisan octane:start

octane-stop:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) php artisan octane:stop

octane-reload:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) php artisan octane:reload
