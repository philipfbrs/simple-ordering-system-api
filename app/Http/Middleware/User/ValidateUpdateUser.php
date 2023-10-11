<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateUpdateUser
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
        $id = $request->route('id');

        $input = Validator::make($request->all(), [
            'first_name' => 'nullable|string|filled',
            'last_name' => 'nullable|string|filled',
            'email' => 'nullable|email|filled',
            'username' => 'nullable|string|filled',
            'password' => 'nullable|string|filled',
        ]);

        if ($input->fails() || (empty($request->has('first_name')) && empty($request->has('last_name')) && empty($request->has('email')) && empty($request->has('username')) && empty($request->has('password'))))
            return response([
                'message' => "Invalid Payload",
                'status' => "error"
            ], 400);

        if (!$id)
            return response([
                'message' => "Invalid Parameter",
                'status' => "error"
            ], 400);

        return $next($request);
    }
}