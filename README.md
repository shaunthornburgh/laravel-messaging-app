## About

This is a Laravel application to demonstrate how to integrate Pusher for real time notifications.

You will need a Pusher account.

## Local Development

To build locally, use the following commands:

```bash
git clone git@github.com:shaunthornburgh/laravel-messaging-app.git
cd laravel-messaging-app
composer install
cp .env.example .env
sail artisan key:generate
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail npm i
./vendor/bin/sail npm run dev
