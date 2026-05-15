# Laravel Docker Boilerplate

A modern Docker boilerplate for Laravel applications with PostgreSQL, Nginx, and PM2 process management.

## Table of Contents
- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Deployment](#deployment)
- [Docker Setup](#docker-setup)
- [Environment Variables](#environment-variables)

## Features

- Laravel 13.x application framework
- PostgreSQL 17 database
- Nginx 1.26.3+ web server
- PHP 8.3.19 / PHP 8.4.17 runtime
- Node.js v22.14.0 for frontend assets
- PM2 process manager for Node.js applications
- Docker-based development and deployment
- Environment-based configuration

## System Requirements

### Operating System
- Ubuntu 24.04 LTS

### Application Server (VM APP)
- 2 vCPUs
- 4 GB RAM
- 100 GB Storage

### Database Server (VM DB)
- 4 vCPUs
- 4 GB RAM
- 150 GB Storage

### Required Software
- **Node.js**: v22.14.0 (Runtime JS)
- **PHP**: 8.3.19 / 8.4.17 (Runtime backend PHP)
- **PM2**: 6.0.14 or above (Process manager)
- **PostgreSQL**: 17 (Database)
- **Nginx**: 1.26.3 or above (Web server)
- **Composer**: 2.8.6 or above (Package Manager PHP)

## Installation

1. Clone the repository
```bash
git clone <repository-url>
cd docker-webapp-laravel
```

2. Copy the example environment file
```bash
cp .env.example .env
```

3. Build image
```bash
docker compose build
```

4. Install laravel 13
```bash
mkdir app && source .env && docker run -ti --rm -v ./app:/app ${IMAGE_NAME}:${IMAGE_VERSION} bash -c "composer create-project laravel/laravel:13 . && chown 1000 -R ."
```

5. Generate application key
```bash
source .env && docker run -ti --rm -v ./app:/app ${IMAGE_NAME}:${IMAGE_VERSION} bash -c "php artisan key:generate"
```

6. Run database migrations

*Atur koneksi ke database:*

> DB_CONNECTION=pgsql <br>
> DB_HOST=database <br>
> DB_PORT=5432 <br>
> DB_DATABASE=app <br>
> DB_USERNAME=app <br>
> DB_PASSWORD=app <br>

```bash
source .env
docker compose up -d 
docker compose exec app php artisan migrate:fresh
```

## Configuration

### Environment Variables
The application uses environment variables for configuration. See `.env.example` for all available options.

### Docker Configuration
The project uses `docker-compose.yml` to define:
- Web server (Nginx)
- Application server (PHP-FPM)
- Database (PostgreSQL)
- Node.js service (for frontend assets)

## Usage

### Development
```bash
# Start all services
docker compose up -d

# Stop all services
docker compose down

# View logs
docker compose logs -f

# Monitoring Resource
docker stats app web database
docker stats app web database --no-stream
```

### Running Commands
```bash
# Execute Laravel commands
docker compose exec app php artisan

# Run npm commands
docker compose exec node npm run dev
```

## Deployment

### Production Deployment
1. Ensure all environment variables are set in production
2. Build the production images:
```bash
docker compose -f docker-compose.yml build
```
3. Start the services:
```bash
docker compose -f docker-compose.yml up -d
```

### Database Migration
```bash
docker compose exec app php artisan migrate --force
```

### Cache Clearing
```bash
docker compose exec app php artisan config:clear
docker compose exec app php artisan cache:clear
```

### Cek Semua Driver Database yang Aktif

Jika Anda ingin melihat driver database apa saja yang didukung oleh PDO saat ini, pada `php artisan tinker`jalankan:
```php
PDO::getAvailableDrivers();
```

## Docker Setup

### Services Included
- **app**: Laravel application with PHP-FPM
- **nginx**: Web server with SSL support
- **db**: PostgreSQL database
- **node**: Node.js environment for frontend assets

### Docker Volumes
- Application code mounted from host
- Database data persisted in named volumes
- Node.js modules cached in volumes

## Environment Variables

### Required Variables
```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=database
DB_PORT=5432
DB_DATABASE=app
DB_USERNAME=app
DB_PASSWORD=app

BROADCAST_DRIVER=log
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
SESSION_LIFETIME=120

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

## Contributing

Contributions are welcome! Please follow the standard GitHub workflow:
1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a pull request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.