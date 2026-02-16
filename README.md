# Viganext

A Laravel application with PHP and PostgreSQL running in Docker containers.

## Prerequisites

Make sure you have the following installed on your system:

- [Git](https://git-scm.com/downloads)
- [Docker Desktop](https://www.docker.com/products/docker-desktop) (includes Docker and Docker Compose)

## Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/carmelocastiglione/viganext.git
cd viganext
```

### 2. Create Environment File

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

Update the `.env` file with the following database configuration:

```env
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=viganext
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

### 3. Install PHP Dependencies

You have two options:

**Option A: Install locally (if you have PHP 8.3+ and Composer installed)**

If PHP and Composer are already on your machine, install dependencies locally for faster artisan commands:

```bash
composer install
```

This allows you to run `php artisan` commands directly without the Docker prefix.

**Option B: Install in Docker container**

If you only have Docker installed, install dependencies inside the container:

```bash
docker-compose exec web composer install
```

You'll need to use `docker-compose exec web php artisan` prefix for all artisan commands.

### 4. Build and Start Docker Containers

Build and start all services:

```bash
docker-compose up -d
```

This will:
- Build the Laravel/PHP application image
- Start the PHP-FPM service
- Start the Nginx web server
- Start the PostgreSQL database

Wait for the PostgreSQL service to be healthy (about 10-15 seconds).

### 5. Generate Application Key

Generate a unique application key for Laravel:

```bash
docker-compose exec web php artisan key:generate
```

### 6. Run Database Migrations

Set up the database schema:

```bash
docker-compose exec web php artisan migrate
```

### 7. (Optional) Seed the Database

If you have seeders, populate the database with sample data:

```bash
docker-compose exec web php artisan db:seed
```

## Access the Application

Once everything is running:

- **Web Application**: http://localhost
- **PostgreSQL Database**: `localhost:5432`
  - Username: `postgres`
  - Password: `postgres`
  - Database: `viganext`

## Useful Docker Commands

### View Logs

View logs from all services:

```bash
docker-compose logs -f
```

View logs from a specific service:

```bash
docker-compose logs -f web     # Laravel app
docker-compose logs -f nginx   # Web server
docker-compose logs -f postgres # Database
```

### Execute Commands in Container

If you're **only** using Docker (no local PHP):

```bash
# Run Laravel artisan commands
docker-compose exec web php artisan <command>

# Access the application shell
docker-compose exec web /bin/sh

# Run PHP code
docker-compose exec web php -r "echo phpinfo();"
```

**Note:** If you installed PHP and Composer locally, you can skip the `docker-compose exec web` prefix and run commands directly from your terminal.

### Common Laravel Commands

**Option 1: Using Docker (recommended if PHP not installed locally)**

```bash
# Create/refresh database
docker-compose exec web php artisan migrate:refresh

# Generate model and migration
docker-compose exec web php artisan make:model ModelName -m

# Create a controller
docker-compose exec web php artisan make:controller ControllerName

# Tinker shell
docker-compose exec web php artisan tinker
```

**Option 2: Direct Commands (if PHP and Composer are installed locally)**

If you have PHP 8.3+ and Composer installed on your local machine, you can run artisan commands directly:

```bash
# Create/refresh database
php artisan migrate:refresh

# Generate model and migration
php artisan make:model ModelName -m

# Create a controller
php artisan make:controller ControllerName

# Tinker shell
php artisan tinker

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

This is faster for development and doesn't require the Docker prefix.

## Stop and Remove Containers

Stop containers gracefully:

```bash
docker-compose stop
```

Stop and remove all containers:

```bash
docker-compose down
```

Remove containers and delete database volume:

```bash
docker-compose down -v
```

## Rebuild Containers

If you modify the `Dockerfile` or dependencies:

```bash
docker-compose up -d --build
```

## Troubleshooting

### Permission Denied Errors

If you encounter permission issues with the `storage` or `bootstrap/cache` directories:

```bash
docker-compose exec web chmod -R 775 storage bootstrap/cache
```

### Database Connection Failed

Ensure PostgreSQL is healthy:

```bash
docker-compose ps
```

The `postgres` container should show a `healthy` status. If not, wait a few seconds and check again.

### Clear Cache

Clear Laravel's application cache:

**Using Docker:**
```bash
docker-compose exec web php artisan cache:clear
docker-compose exec web php artisan config:clear
docker-compose exec web php artisan view:clear
```

**Or directly (if PHP is installed locally):**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Reset Database

Start fresh with a new database:

```bash
docker-compose down -v
docker-compose up -d
docker-compose exec web php artisan migrate
```

## Project Structure

```
viganext/
├── Dockerfile              # PHP-FPM container image
├── docker-compose.yml      # Container orchestration
├── docker/
│   └── nginx/
│       └── nginx.conf      # Nginx configuration
├── app/                    # Laravel application code
├── resources/              # Views and assets
├── routes/                 # Application routes
├── database/               # Migrations and seeders
├── storage/                # Logs and file storage
├── config/                 # Configuration files
└── .env                    # Environment variables (create from .env.example)
```

## Services Overview

- **web**: PHP 8.3-FPM application server
- **nginx**: Reverse proxy and web server (port 80)
- **postgres**: PostgreSQL 16 database (port 5432)

All services communicate through a Docker network and persist data in volumes.

## Development

To enable debug mode, update your `.env`:

```env
APP_DEBUG=true
APP_ENV=local
```

Then restart the containers:

```bash
docker-compose restart
```

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Docker Documentation](https://docs.docker.com/)
- [PostgreSQL Documentation](https://www.postgresql.org/docs/)

## License

This project is open source and available under the [MIT license](LICENSE).
