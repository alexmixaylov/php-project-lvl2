install:
	composer install

lint:
	bin/phpcs --standard=PSR12  ./src

test-coverage:
	composer exec --verbose phpunit tests -- -d --coverage-clover build/logs/clover.xml
