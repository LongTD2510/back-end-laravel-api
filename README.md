## Environment
- Install Docker Windows (WSL2)
- Install Docker Linux

## Clone project
- `git clone git@github.com:sotatek-dev/bgs_api.git`
- `cd bgs_api`


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


