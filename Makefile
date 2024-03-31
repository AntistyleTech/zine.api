bash-s:
	@docker compose run --user 1000:1000 app bash

bash-r:
	@docker compose run --user root app bash

build:
	@docker compose build

up:
	@docker compose up
