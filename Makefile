
database:
	php bin/console doctrine:database:drop --force
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:update --force

prepare:
	make database env=$(env)
	make fixtures env=$(env)