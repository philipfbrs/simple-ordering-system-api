<?php

namespace App\Http\Middleware\Product;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateUpdateProduct
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
            'name' => 'nullable|string|filled',
            'price' => 'nullable|integer|filled',
        ]);

        if ($input->fails() || (empty($request->has('name')) && empty($request->has('price'))))
            return response([
                'message' => "Invalid Payload",
                'status' => "error"
            ], 400);

        if (!$id || !is_numeric($id))
            return response([
                'message' => "Invalid Parameter",
                'status' => "error"
            ], 400);

        return $next($request);
    }
}