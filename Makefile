start:
	php artisan serve

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate

deploy:
	git push heroku

lint:
	composer run-script phpcs

lint-fix:
	composer run-script phpcbf -- --standard=PSR12 public tests

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test