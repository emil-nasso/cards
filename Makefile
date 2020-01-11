migrate-dev:
	php artisan migrate:fresh --seeder=DevelopmentSeeder

build:
	docker build -t cards .

upd:
	docker run --rm -d -p 9999:80 --name cards cards

stop:
	docker stop cards
