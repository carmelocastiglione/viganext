# Viganext

A Laravel application with local PHP development and PostgreSQL running in Docker.

## Prerequisites

Make sure you have the following installed on your system:

- [Git](https://git-scm.com/downloads)
- [PHP 8.4+](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [Docker Desktop](https://www.docker.com/products/docker-desktop) (for PostgreSQL)

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
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=viganext
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

### 3. Start PostgreSQL Database

Start only the PostgreSQL container:

```bash
docker-compose up -d
```

Wait for the PostgreSQL service to be healthy (about 10-15 seconds).

### 4. Install PHP Dependencies

Install Laravel dependencies locally using Composer:

```bash
composer install
```

### 5. Generate Application Key

Generate a unique application key for Laravel:

```bash
php artisan key:generate
```

### 6. Run Database Migrations

Set up the database schema:

```bash
php artisan migrate
```

### 7. (Optional) Seed the Database

If you have seeders, populate the database with sample data:

```bash
php artisan db:seed
```

### 8. Seed the Database with Users and Roles (Recommended)
The easiest way to populate the database with sample data is using Laravel seeders:

```bash
php artisan db:seed
```

This will create:
- **Admin User**: email `admin@issvigano.org`, password `password`
- **Roles**: admin, teacher, student, external
- **Projects**: vigaspecialweek, ciclab, mercatino
- **Role Assignment**: Admin user assigned to the admin role

### 9. Add user to Database Manually (Optional)
If you prefer to create a user manually, you can use the Tinker shell:

```bash
php artisan tinker
```

Then run the following code in the Tinker shell:

```php
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Create roles if they don't exist
$roles = ['admin', 'teacher', 'student', 'external'];
foreach ($roles as $roleName) {
    Role::firstOrCreate(['name' => $roleName], ['description' => ucfirst($roleName) . ' role']);
}

// Create admin user
$user = User::create([
    'name' => 'Admin',
    'surname' => 'VigaNext',
    'email' => 'admin@issvigano.org',
    'email_verified_at' => now(),
    'password' => Hash::make('password'),
    'remember_token' => Str::random(10),
]);

// Assign admin role to the user
$adminRole = Role::where('name', 'admin')->first();
if ($adminRole) {
    $user->roles()->attach($adminRole->id);
}
```

### 10. Start the Local Development Server

Start the Laravel development server:

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000`

## Access the Application

Once everything is running:

- **Web Application**: http://localhost:8000
- **PostgreSQL Database**: `localhost:5432`
  - Username: `postgres`
  - Password: `postgres`
  - Database: `viganext`

## Useful Docker Commands

### View Database Logs

View logs from the PostgreSQL service:

```bash
docker-compose logs -f postgres
```

## Common Laravel Commands

Run these commands directly from your local terminal:

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

# Create queued job
php artisan make:job JobName

# Run scheduled tasks
php artisan schedule:work
```

## Stop and Remove Containers

Stop the PostgreSQL container gracefully:

```bash
docker-compose stop
```

Stop and remove containers:

```bash
docker-compose down
```

Remove containers and delete database volume (reset database):

```bash
docker-compose down -v
```

## Troubleshooting

### Database Connection Failed

Ensure PostgreSQL is running and healthy:

```bash
docker-compose ps
```

The `postgres` container should show a `healthy` status. If not, wait a few seconds and check again.

You can also test the connection directly:

```bash
psql -h localhost -U postgres -d viganext
```

### Clear Cache

Clear Laravel's application cache:

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
php artisan migrate
```

### Laravel Server Issues

If the Laravel development server won't start, ensure:
- No other process is using port 8000
- PostgreSQL is running and accessible
- All dependencies are installed (`composer install`)

You can specify a different port:

```bash
php artisan serve --port=8001
```

## Project Structure

```
viganext/
├── Dockerfile              # Reference Docker image (optional)
├── docker-compose.yml      # PostgreSQL container only
├── app/                    # Laravel application code
├── resources/              # Views and assets
├── routes/                 # Application routes
├── database/               # Migrations and seeders
├── storage/                # Logs and file storage
├── config/                 # Configuration files
└── .env                    # Environment variables (create from .env.example)
```

## Services Overview

- **Local PHP**: Laravel development server running on your machine (port 8000)
- **postgres**: PostgreSQL 16 database container (port 5432)

PHP and Composer run locally for fast development and direct command execution.

## Development

To enable debug mode, update your `.env`:

```env
APP_DEBUG=true
APP_ENV=local
```

Then restart the Laravel development server:

```bash
# Stop the current server with Ctrl+C, then
php artisan serve
```

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Docker Documentation](https://docs.docker.com/)
- [PostgreSQL Documentation](https://www.postgresql.org/docs/)

## License

This project is open source and available under the [MIT license](LICENSE).
