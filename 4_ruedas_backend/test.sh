echo "🦊  Building databases ... \n"
rm testing.sqlite || true
touch testing.sqlite
php artisan cache:clear --env=testing
php artisan config:cache --env=testing
php artisan migrate:fresh --env=testing
echo "\n🦊 ️ Migration finished\n"

echo "\n🦊  Running test ... \n"
php artisan env
php artisan test
php artisan config:cache --env=local
php artisan env
