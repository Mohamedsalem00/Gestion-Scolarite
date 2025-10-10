#!/bin/bash

echo "Starting Laravel application..."

# Wait for database to be ready (only if DB_HOST is set and not localhost/127.0.0.1)
if [ -n "$DB_HOST" ] && [ "$DB_HOST" != "localhost" ] && [ "$DB_HOST" != "127.0.0.1" ]; then
    echo "Waiting for database connection at $DB_HOST:${DB_PORT:-3306}..."
    
    # Check if nc command is available
    if command -v nc >/dev/null 2>&1; then
        counter=0
        max_attempts=30
        while ! nc -z "$DB_HOST" "${DB_PORT:-3306}" 2>/dev/null; do
            counter=$((counter+1))
            if [ $counter -ge $max_attempts ]; then
                echo "Warning: Could not connect to database after $max_attempts attempts. Continuing anyway..."
                break
            fi
            echo "Waiting for database... (attempt $counter/$max_attempts)"
            sleep 2
        done
        echo "Database connection check complete!"
    else
        echo "Skipping database connection check (nc not available)"
        sleep 5
    fi
else
    echo "Skipping database connection check (no external database configured)"
fi

# Create storage directories if they don't exist
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/logs

# Set proper permissions
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache configuration for better performance
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (uncomment if you want auto-migration on startup)
# echo "Running migrations..."
# php artisan migrate --force

# Create storage link
if [ ! -L /var/www/html/public/storage ]; then
    echo "Creating storage link..."
    php artisan storage:link
fi

echo "Laravel application is ready!"

# Execute the main command (Apache)
exec "$@"
