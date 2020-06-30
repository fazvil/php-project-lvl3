start:
	sudo service postgresql start
	php artisan serve

setup:
	composer install

deploy:
	git push heroku

lint:
	composer run-script phpcs -- --standard=PSR12 public tests

lint-fix:
	composer run-script phpcbf -- --standard=PSR12 public tests

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test