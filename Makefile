env=local
container=app

uid=1000
gid=1000

.PHONY: install composer-install npm-install artisan-migrate artisan-migrate rebuild

install: build composer-install npm-install artisan-migrate up

composer-install:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) composer install

npm-install:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) npm install

artisan-migrate:
	@docker compose -f compose.$(env).yaml exec --user $(uid):$(gid) $(container) php artisan migrate

rebuild:
	@docker compose -f compose.$(env).yaml up -d --build --force-recreate


.PHONY: up down restart build exec

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

