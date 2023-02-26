tests:
	@vendor/bin/phpunit test

linterfix:
	@vendor/bin/phpcbf src

linter:
	@vendor/bin/phpcs --standard=PSR12 src

stan:
	@vendor/bin/phpstan analyse -l 9 src --memory-limit=-1

check:
	make linter
	male stan
	make tests

