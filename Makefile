
env=local
container=api

UID=1000
GID=1000

.PHONY: exec

install: composer-install

composer-install:
	@MAKE exec composer install

exec:
	@docker compose -p zine exec --user $(uid):$(gid) $(container) sh
