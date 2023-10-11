<?php

namespace App\Http\Middleware\Cart;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateAddToCart
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
            'order_by' => 'required|string',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);
        
        if ($input->fails())
            return response([
                'message' => "Invalid Payload",
                'status' => "error"
            ], 400);


        return $next($request);
    }
}