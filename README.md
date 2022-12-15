## Environment
- Install Docker Windows (WSL2)
- Install Docker Linux

## Install project
- `docker-compose build`
- `docker-compose up -d`
- `docker ps` for view containers
- `docker exec app bash`
- `cp .env.example .env`
- edit `.env` information
- `composer install`
- `chmod -R 775 storage`
- `php artisan migrate`
- `php artisan passport:install`
## Make repository
- `php artisan make:repository your-repository-name`

## Example:
- `php artisan make:repository UserRepository`
- `php artisan make:repository Backend/UserRepository`

