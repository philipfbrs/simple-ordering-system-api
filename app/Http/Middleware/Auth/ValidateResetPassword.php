<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateResetPassword
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

        $token = $request->query('token');
        if (!$token)
            return response([
                'message' => "Invalid Token",
                'status' => "error"
            ], 400);

        $input = Validator::make($request->all(), [
            'password' => 'required|string',
            'confirmPassword' => 'required|string',
        ]);

        if ($input->fails())
            return response([
                'message' => "Invalid Payload",
                'status' => "error"
            ], 400);

        return $next($request);
    }
}