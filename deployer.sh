set -e

echo "Deploying application ..."

# Enter maintenance mode
(php artisan down --message 'The app is being updated. Please try again in a minute') || true
    #update codebase
    git pull origin master
# exit maintenance mode
php artisan update

echo "application deployed!"