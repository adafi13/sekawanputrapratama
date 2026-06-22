#!/bin/bash

# Deploy Script untuk cPanel
# Run script ini setiap kali ada update dari Git

echo "🚀 Starting deployment..."

# Go to project directory
cd /home/username/public_html

# Pull latest changes
echo "📥 Pulling latest changes from Git..."
git pull origin main

# Install/Update Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

# Frontend/admin assets (public/build) are built locally and committed
# to git, since this server has no Node.js/npm — nothing to do here.

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Clear all caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Rebuild caches
echo "⚡ Building caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart queue workers
echo "🔄 Restarting queue workers..."
php artisan queue:restart

# Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage bootstrap/cache

echo "✅ Deployment completed successfully!"
echo "🌐 Check website: https://sekawanputrapratama.com"
