#!/bin/bash
# render-debug.sh - Run this in Render SSH to debug issues

echo "=== Render Environment Debug ==="
echo ""

echo "1. Environment Variables:"
env | grep -E "APP_|DB_" | sort
echo ""

echo "2. APP_KEY Status:"
php -r "echo 'APP_KEY set: ' . (getenv('APP_KEY') ? 'Yes' : 'No') . PHP_EOL;"
echo ""

echo "3. Database Connection:"
php artisan tinker --execute="
try {
    \DB::connection()->getPdo();
    echo 'Database: Connected ✓' . PHP_EOL;
    echo 'Host: ' . env('DB_HOST') . PHP_EOL;
    echo 'Database: ' . env('DB_DATABASE') . PHP_EOL;
} catch (Exception \$e) {
    echo 'Database: FAILED ✗' . PHP_EOL;
    echo 'Error: ' . \$e->getMessage() . PHP_EOL;
}
"
echo ""

echo "4. Storage & Cache Permissions:"
ls -la storage/ | head -5
echo ""

echo "5. Recent Logs (last 20 lines):"
tail -20 storage/logs/laravel.log
echo ""

echo "6. Application Status:"
php artisan status
