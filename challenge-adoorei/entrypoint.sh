#!/usr/bin/env sh

composer install --no-interaction

npm install --no-interaction --no-progress

composer dump-autoload
php artisan l5-swagger:generate
php artisan clear-compiled && \
php artisan config:clear && \
php artisan event:clear && \
php artisan cache:clear && \
php artisan view:clear && \
php artisan route:clear && \
php artisan optimize:clear && \
php artisan optimize

echo "Running migrations"
php artisan migrate:fresh --seed
echo "Migrations ran successfully"


echo "Starting server"
php artisan octane:start --watch --server=swoole --port=9090 --workers=4 --host=0.0.0.0
