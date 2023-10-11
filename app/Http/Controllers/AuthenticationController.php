<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function Login(Request $request)
    {

        try {
            $user = $request->only('email', 'password');
           
            $validated = User::where('email', '=', $user['email'])->first();
            if (!$validated || !password_verify($user['password'], $validated->password)) {
                $invalid = array(
                    'message' => 'Invalid Username or Password'
                );
                return response($invalid, 400)
                    ->header('Content-Type', 'application/json');
            }

            $access_token = $this->createWebToken($validated->id, $validated->email);

            $response = array(
                'accessToken' => $access_token
            );

            return response((array) $response, 200)
                ->header('Content-Type', 'application/json');

        } catch (Exception $exc) {
            return response($exc, 500);
        }
    }
}
