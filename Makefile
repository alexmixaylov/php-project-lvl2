install:
	composer install

lint:
	bin/phpcs --standard=PSR12  ./src

test-coverage:
	composer exec -vvv XDEBUG_MODE=coverage phpunit tests -- --coverage-clover build/logs/clover.xml --debug