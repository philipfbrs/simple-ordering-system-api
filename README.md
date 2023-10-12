1. Open the .env file and configure the database connection.

2. Open the terminal and run "npm install", "composer update", and "php artisan migrate:refresh --seed"
    
    Note: It automatically creates the product and the first user.

    Credentials: email: admin_os@gmail.com password: abc123

3. Open (2) terminal and run "php artisan serve" and "php artisan queue:work"
