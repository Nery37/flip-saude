CONTAINER_NAME=flip_saude_application

install:
	make up
	make composer-install
	make migrate

up:
	docker-compose up -d

down:
	docker-compose down

bash:
	docker exec -it $(CONTAINER_NAME) sh

build:
	docker-compose build

force-recreate:
	docker-compose up -d --force-recreate --build

composer-install:
	make up
	docker exec -t $(CONTAINER_NAME) composer install
	docker exec -t $(CONTAINER_NAME) php artisan key:generate

migrate:
	docker exec $(CONTAINER_NAME) php artisan migrate --path=/database/migrations --seed --force

test:
ifdef FILTER
	make up
	docker exec -t $(CONTAINER_NAME) composer unit-test -- --filter="$(FILTER)"
else
	make up
	docker exec -t $(CONTAINER_NAME) composer unit-test
endif

logs:
	make up
	docker-compose logs --follow

clear:
	make up
	docker exec $(CONTAINER_NAME) sh -c "php artisan optimize:clear"

coverage-html:
	make clear
	docker exec -t $(CONTAINER_NAME) composer test-coverage-html

format:
	make up
	docker exec -t $(CONTAINER_NAME) composer lint-fix
