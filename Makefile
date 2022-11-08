run-server:
# symfony serve -d
	php -S 127.0.0.1:8000 -t public

clear-cache:
	bin/console cache:clear

api:
# bin/console api:json-schema:generate
	bin/console api:openapi:export

entity:
# bin/console api:json-schema:generate
	bin/console make:entity --api-resource