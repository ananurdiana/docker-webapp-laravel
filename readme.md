# Laravel Docker Boilerplate

A modern Docker boilerplate for Laravel applications with PostgreSQL, Nginx, and PM2 process management.

## Table of Contents
- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Deployment](#deployment)
- [Environment Variables](#environment-variables)

## Features

- Laravel 9.x application framework
- PostgreSQL 17 database
- Nginx 1.26.3+ web server
- PHP 8.1.32
- Node.js v22.22.2 for frontend assets
- PM2 process manager for Node.js applications
- Docker-based development and deployment
- Environment-based configuration


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

4. Install laravel 9
```bash
mkdir app && source .env && docker run -ti --rm -v ./app:/app ${IMAGE_NAME}:${IMAGE_VERSION} bash -c "composer create-project laravel/laravel:9 . && chown 1000 -R ."
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

## Contributing

Contributions are welcome! Please follow the standard GitHub workflow:
1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a pull request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.