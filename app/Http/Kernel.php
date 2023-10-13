<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
            // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
                // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,


        # DECLARED CUSTOM MIDDLEWARE 

        #Product
        'validate-create-product' => \App\Http\Middleware\Product\ValidateCreateProduct::class,
        'validate-get-product' => \App\Http\Middleware\Product\ValidateGetProduct::class,
        'validate-update-product' => \App\Http\Middleware\Product\ValidateUpdateProduct::class,
        'validate-delete-product' => \App\Http\Middleware\Product\ValidateDeleteProduct::class,

        #User
        'validate-create-user' => \App\Http\Middleware\User\ValidateCreateUser::class,
        'validate-get-user' => \App\Http\Middleware\User\ValidateGetUser::class,
        'validate-update-user' => \App\Http\Middleware\User\ValidateUpdateUser::class,
        'validate-delete-user' => \App\Http\Middleware\User\ValidateDeleteUser::class,

        #Cart
        'validate-add-to-cart' => \App\Http\Middleware\Cart\ValidateAddToCart::class,
        'validate-get-cart' => \App\Http\Middleware\Cart\ValidateGetCart::class,
        'validate-purchase-order' => \App\Http\Middleware\Cart\ValidatePurchaseOrder::class,
    
        #Authentication
        'validate-api-key' => \App\Http\Middleware\Auth\ValidateApiKey::class,
        'validate-access-token' => \App\Http\Middleware\Auth\ValidateAccessToken::class,
        'validate-login' => \App\Http\Middleware\Auth\ValidateLogin::class,
        'validate-request-reset-password' => \App\Http\Middleware\Auth\ValidateRequestResetPassword::class,
        'validate-reset-password' => \App\Http\Middleware\Auth\ValidateResetPassword::class,
    ];
}