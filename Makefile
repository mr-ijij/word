check: phpcs phpstan

phpcs:
	./App/vendor/bin/phpcs --standard=PSR12 --ignore=vendor/ --extensions=php ./App/

phpstan:
	./App/vendor/bin/phpstan analyse ./App/ --level=8

phpunit:
	./App/vendor/bin/phpunit ./App/tests/