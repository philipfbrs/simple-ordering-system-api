<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use ReallySimpleJWT\Token;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createWebToken($id, $email)
	{
		$payload = [
			'iat' => time(),
			'id' => $id,
			'e' => $email,
			'exp' => time() + 43200,
			'iss' => 'simple-ordering-system'
		];
		$secret = env('SECRET_ACCESS_TOKEN');
		$token = Token::customPayload($payload, $secret);
		return $token;
	}

	// public function createResetToken($token)
	// {
	// 	$payload = [
	// 		'iat' => time(),
	// 		//	'userId' => $id,
	// 		'u' => $token,
	// 		'exp' => time() + 180,
	// 		//seconds webtoken expiration 	
	// 		'iss' => 'simple-ordering-system'
	// 	];
	// 	$secret = env('SECRET_ACCESS_TOKEN');

	// 	$passwordToken = Token::customPayload($payload, $secret);

	// 	return $passwordToken;
	// }
}
