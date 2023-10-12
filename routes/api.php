<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//
//PRODUCTS API
//

Route::prefix('product')->group(function () {

    // CREATE PRODUCT
    Route::post(
        '/',
        'ProductController@createProduct'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-create-product'])->name('create-product');

    // UPDATE PRODUCT
    Route::put(
        '/{id?}',
        'ProductController@updateProduct'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-update-product'])->name('update-product');

    // DELETE PRODUCT
    Route::delete(
        '/{id?}',
        'ProductController@deleteProduct'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-delete-product'])->name('delete-product');

    // VIEW PRODUCT
    Route::post(
        '/',
        'ProductController@getProduct'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-get-product'])->name('get-product');

});


//
//USER API
//


Route::prefix('user')->group(function () {

    // CREATE User
    Route::post(
        '/',
        'UserController@createUser'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-create-user'])->name('create-User');

    // UPDATE User
    Route::put(
        '/{id?}',
        'UserController@updateUser'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-update-user'])->name('update-User');

    // DELETE User
    Route::delete(
        '/{id?}',
        'UserController@deleteUser'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-delete-user'])->name('delete-User');

    // VIEW User
    Route::get(
        '/{id}',
        'UserController@getUser'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-get-user'])->name('get-User');

});


//
//CART API
//


Route::prefix('cart')->group(function () {

    // ADD TO CART
    Route::post(
        '/add',
        'CartController@addToCart'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-add-to-cart'])->name('add-to-cart');

    // ADD TO CART
    Route::post(
        '/',
        'CartController@getCart'
    )->middleware(['validate-api-key', 'validate-access-token', 'validate-get-cart'])->name('add-to-cart');

    // ADD TO CART
    Route::post(
        '/{id}',
        'CartController@purchaseOrder'
    )->middleware(['validate-api-key', 'validate-access-token'])->name('purchase-order');

});


//
//AUTH API
//


Route::prefix('auth')->group(function () {

    // LOGIN
    Route::post(
        '/login',
        'AuthenticationController@Login'
    )->middleware(['validate-api-key', 'validate-login'])->name('login');

});

//
//
//