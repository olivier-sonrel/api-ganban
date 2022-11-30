run:
# symfony serve -d
	sudo service mysql start
	php -S 127.0.0.1:8000 -t public

clear-cache:
	bin/console cache:clear

api:
# bin/console api:json-schema:generate
	bin/console api:openapi:export

entity:
# bin/console api:json-schema:generate
	bin/console make:entity --api-resource

migration:
	bin/console doctrine:migrations:diff

migrate:
	bin/console doctrine:migrations:migrate

migration-migrate: migration migrate
	echo "doing migrations" 

clean-migration:
	rm -rf ./migrations/*

drop-bdd:
	bin/console doctrine:database:drop --force

create-bdd:
	bin/console doctrine:database:create

reload-bdd: clean-migration drop-bdd create-bdd migration migrate api
	echo "reload bdd and migrations"

######### PHP STAN #########
stan:
	@echo ----------------- Run phpStan ------------------
	php ./vendor/bin/phpstan analyse -c phpstan.neon --no-progress

test: stan
