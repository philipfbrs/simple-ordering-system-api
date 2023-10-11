<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use ReallySimpleJWT\Token;

class ValidateAccessToken
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
        if (!$request->hasHeader('Authorization') || empty($request->header('Authorization'))) {
            $invalid = array(
                'message'=>'Missing Request Header',           
             );
            return response($invalid,401)
            ->header('Content-Type','application/json');
        }

        $basic = $request->header('Authorization');

        $basic_split = explode(' ',$basic);

        $secret = env('SECRET_ACCESS_TOKEN');
		$result = Token::validate($basic_split[1], $secret);            

        if(!$result){
            $invalid = array(
                'message'=>'Invalid authorization token',           
             );
            return response($invalid,401)
            ->header('Content-Type','application/json');
        }
        
        return $next($request);
    }
}