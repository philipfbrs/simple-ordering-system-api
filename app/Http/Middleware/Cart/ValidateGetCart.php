<?php

namespace App\Http\Middleware\Cart;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateGetCart
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

        $input = Validator::make($request->all(), [
            'page' => 'required|integer',
            'limit' => 'required|integer',
            'search' => 'required|string',
            'filter' => 'nullable|string',
            'tabStatus' => 'required|string',
        ]);
        if ($input->fails())
            return response([
                'message' => "Invalid Payload",
                'status' => "error"
            ], 400);


        return $next($request);
    }
}