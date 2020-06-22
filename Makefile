start:
	php artisan serve

setup:
	composer install

deploy:
	git push heroku

lint:
	composer run-script phpcs -- --standard=PSR12 public

lint-fix:
	composer run-script phpcbf -- --standard=PSR12 public
