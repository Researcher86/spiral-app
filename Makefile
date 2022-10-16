#export XDEBUG_CONFIG=client_host=127.0.0.1 client_port=9000
#export PHP_IDE_CONFIG=serverName=spiral
#export XDEBUG_SESSION=start_with_request=yes

up:
	docker-compose up -d

down:
	docker-compose down -v

logs:
	docker-compose logs

test:
	vendor/bin/phpunit --colors=always --testdox

test-debug:
	/bin/php -dxdebug.mode=debug vendor/bin/phpunit --colors=always --testdox

run:
	./rr serve

run-debug:
	#./rr serve -c .rr.dev.yaml  -o "server.command=php -dxdebug.mode=debug -dxdebug.client_port=9000 -dxdebug.client_host=127.0.0.1 app.php"
	./rr serve -c .rr.dev.yaml  -o "server.command=php -dxdebug.mode=debug app.php"

workers:
	./rr workers -i

bench:
    # https://github-wiki-see.page/m/giltene/wrk2/wiki/Installing-wrk2-on-Linux#:~:text=Installing%20wrk2%20on,wrk%20and%20build.
	wrk -c2000 -t200 -R5000 http://localhost:8080/users/5
