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

# Create .env file from environment variables if it doesn't exist
if [ ! -f /var/www/html/.env ]; then
    echo "Creating .env file from environment variables..."
    
    # Copy from example or create empty
    if [ -f /var/www/html/.env.example ]; then
        cp /var/www/html/.env.example /var/www/html/.env
    else
        # Create minimal .env file
        cat > /var/www/html/.env <<EOF
APP_NAME="${APP_NAME:-Laravel}"
APP_ENV=${APP_ENV:-production}
APP_KEY=
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}

LOG_CHANNEL=${LOG_CHANNEL:-stack}
LOG_LEVEL=${LOG_LEVEL:-error}

DB_CONNECTION=${DB_CONNECTION:-mysql}
DB_HOST=${DB_HOST:-127.0.0.1}
DB_PORT=${DB_PORT:-3306}
DB_DATABASE=${DB_DATABASE:-laravel}
DB_USERNAME=${DB_USERNAME:-root}
DB_PASSWORD=${DB_PASSWORD:-}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
EOF
    fi
fi

# Update environment variables from Koyeb environment
echo "Updating .env with environment variables..."
if [ -n "$APP_KEY" ]; then
    sed -i "s|APP_KEY=.*|APP_KEY=$APP_KEY|g" /var/www/html/.env
fi
if [ -n "$APP_ENV" ]; then
    sed -i "s|APP_ENV=.*|APP_ENV=$APP_ENV|g" /var/www/html/.env
fi
if [ -n "$APP_DEBUG" ]; then
    sed -i "s|APP_DEBUG=.*|APP_DEBUG=$APP_DEBUG|g" /var/www/html/.env
fi
if [ -n "$APP_URL" ]; then
    sed -i "s|APP_URL=.*|APP_URL=$APP_URL|g" /var/www/html/.env
fi
if [ -n "$DB_HOST" ]; then
    sed -i "s|DB_HOST=.*|DB_HOST=$DB_HOST|g" /var/www/html/.env
fi
if [ -n "$DB_PORT" ]; then
    sed -i "s|DB_PORT=.*|DB_PORT=$DB_PORT|g" /var/www/html/.env
fi
if [ -n "$DB_DATABASE" ]; then
    sed -i "s|DB_DATABASE=.*|DB_DATABASE=$DB_DATABASE|g" /var/www/html/.env
fi
if [ -n "$DB_USERNAME" ]; then
    sed -i "s|DB_USERNAME=.*|DB_USERNAME=$DB_USERNAME|g" /var/www/html/.env
fi
if [ -n "$DB_PASSWORD" ]; then
    sed -i "s|DB_PASSWORD=.*|DB_PASSWORD=$DB_PASSWORD|g" /var/www/html/.env
fi

# Generate application key if not set
if [ -z "$APP_KEY" ] || ! grep -q "^APP_KEY=base64:" /var/www/html/.env; then
    echo "Generating application key..."
    php artisan key:generate --force --ansi
fi

# Clear caches
echo "Clearing caches..."
php artisan config:clear || true
php artisan cache:clear || echo "Warning: Could not clear cache (permissions issue - this is normal on first run)"
php artisan view:clear || true
php artisan route:clear || true

# Cache configuration for better performance
echo "Caching configuration..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

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
