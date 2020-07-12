start:
	php artisan serve

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite

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