type-check:
	php vendor/bin/psalm -c psalm.xml

run-tests:
	php vendor/bin/phpunit tests/*

repl:
	php composer repl
