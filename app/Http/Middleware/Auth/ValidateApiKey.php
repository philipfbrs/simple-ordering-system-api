<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;

class ValidateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('x-api-key')) {
            $invalid = array(
                'message' => 'Missing Request Header'
            );
            return response($invalid, 400)
                ->header('Content-Type', 'application/json');
        }
        $signature = $request->header('x-api-key');
        // VALIDATE API KEY
        $secret = env('SECRET_API_KEY');

        $result = ($signature == $secret);

        if (!$result) {
            $invalid = array(
                'message' => 'Invalid Access Key.',
            );
            return response($invalid, 401)
                ->header('Content-Type', 'application/json');
        }

        return $next($request);
    }
}