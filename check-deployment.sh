#!/bin/bash

# Render Deployment Health Check Script
# Run this locally to identify and fix issues

echo "=== Blog Management Render Deployment Check ==="
echo ""

# Check 1: Generate APP_KEY
echo "Step 1: Generate APP_KEY"
php artisan key:generate --show
echo ""
echo "👆 Copy the above key (starts with 'base64:') to your clipboard"
echo ""

# Check 2: Verify local environment
echo "Step 2: Local Environment Status"
echo "✓ Checking PHP version..."
php --version | head -1
echo ""

echo "✓ Checking Laravel installation..."
php artisan --version
echo ""

# Check 3: Verify database connectivity
echo "Step 3: Testing Database Connection"
php artisan tinker --execute="echo \DB::connection()->getPdo() ? 'Database Connected ✓' : 'Database Failed ✗';"
echo ""

# Check 4: Verify migrations
echo "Step 4: Checking Migrations"
php artisan migrate:status
echo ""

echo "=== Next Steps ==="
echo "1. Copy the APP_KEY value above"
echo "2. Go to Render Dashboard → Your Service → Settings → Environment"
echo "3. Verify these variables are set:"
echo "   - APP_KEY = [paste the key from step 1]"
echo "   - APP_ENV = production"
echo "   - APP_DEBUG = false"
echo "   - APP_URL = https://blog-management-2-157u.onrender.com"
echo "   - DB_CONNECTION = mysql"
echo "   - DB_HOST = [from blog-db service details]"
echo "   - DB_PORT = 3306"
echo "   - DB_DATABASE = blog_management"
echo "   - DB_USERNAME = [from blog-db service]"
echo "   - DB_PASSWORD = [from blog-db service]"
echo ""
echo "4. If any variable is missing, add it"
echo "5. Click 'Manual Deploy' to redeploy"
echo "6. Wait 2-3 minutes and check the website"
echo ""
