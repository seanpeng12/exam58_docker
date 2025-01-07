docker exec -it exam58-php php artisan config:clear
docker exec -it exam58-php php artisan key:generate
docker exec -it exam58-php php artisan migrate