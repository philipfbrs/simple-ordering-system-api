1. Open the .env file and configure the database connection.

2. Open the terminal and run "npm install", "composer update", and "php artisan migrate:refresh --seed"
    
    Note: It automatically creates the product and the first user.

    Credentials: email: admin_os@yopmail.com password: abc123

3. Open (2) terminal and run "php artisan serve" and "php artisan queue:work"

Once you tried to checkout or purchase a product the email will be sent to admin_os@yopmail.com (Owner Account) and you can access that through this link yopmail.com.


It seems like you have a set of instructions for configuring and running a Laravel application, but you've encountered an issue that needs fixing. It appears that you want to send purchase emails to '<your_gmail>@gmail.com' instead of 'admin_os@yopmail.com'. To make this change, follow these steps:

1. Open the CartController.php file located in the app\Http\Controllers directory.

2. Locate the purchaseCart method inside the CartController.php file.

3. Inside the purchaseCart method, you'll find a line like this:
Code:dispatch(new PurchaseEmailJob($fetchTable, 'admin_os@yopmail.com', 'Purchased Order'));

Modify the email address and subject as you mentioned. Replace 'admin_os@yopmail.com' with '<your_gmail>@gmail.com' and change the subject if needed:
Code: dispatch(new PurchaseEmailJob($fetchTable, '<your_gmail>@gmail.com', 'Purchased Order'));

4. Save the changes to the CartController.php file.
With these modifications, the purchase emails will be sent to '<your_gmail>@gmail.com' instead of 'admin_os@yopmail.com' when users make purchases. Make sure you save your changes and then continue with the rest of your instructions.


Api Endpoint:
#CREATE PRODUCT
Create Product - (POST) /api/product
Payload - {
    "name":"Product max",
    "price": "1000"
}

#VIEW PRODUCT
GET Product - (POST) /api/product/add
Payload - {
    "page": 0,
    "limit": 20,
    "search": "8", /*product id can be search too*/
    "filter": "", 
    "tabStatus": "all"
}

#DELETE PRODUCT
DELETE Product - (DELETE) /api/product/:id

UPDATE Product - (PUT) /api/product
Payload{
    "name": "Product max2",
    "price": "1"
}





Reset Password API - /api/auth/reset-password

 
