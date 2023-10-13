<?php

namespace App\Http\Controllers;

use App\Jobs\ResetPasswordJob;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use ReallySimpleJWT\Token;

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

    public function requestResetPassword(Request $request)
    {

        try {

            $input = $request->only('email');

            $isExist = User::where('email', $input['email'])->first();

            if (!$isExist)
                return response((array) 
                    [
                        'message' => 'User does not exist',
                        'status' => "error"
                    ], 404);

            $payload = [
                'iat' => time(),
                'id' => $isExist->id,
                'exp' => time() + 300,
                // 5 mins expiry
                'iss' => '8nergy-hris'
            ];

            $secret = env('SECRET_RESET_PASSWORD_TOKEN');

            $password_token = Token::customPayload($payload, $secret);

            User::where('id', $isExist->id)->update(['reset_token' => $password_token]);

            dispatch(new ResetPasswordJob(['token' => $password_token, 'name' => $isExist->first_name], $input['email'], 'Account Reset Password'));

            return response((array) [
                'message' => 'Reset password was sent!',
                'status' => 'success',
            ], 200)
                ->header('Content-Type', 'application/json');

        } catch (Exception $exc) {
            return response($exc->getMessage(), 500);
        }
    }

    public function resetPassword(Request $request)
    {

        try {
            $input = $request->only('confirmPassword', 'password');
            $token = $request->query('token');
            $isToken = Token::validate($token, env('SECRET_RESET_PASSWORD_TOKEN'));

            if (!$isToken)
                return response((array) [
                    'message' => 'Invalid token',
                    'status' => 'error',
                ], 401)
                    ->header('Content-Type', 'application/json');

            $result = Token::getPayload($token, env('SECRET_RESET_PASSWORD_TOKEN'));

            $user = User::where('id', $result['id'])->first();

            if (!$user)
                return response((array) [
                    'message' => 'User does not exist',
                    'status' => 'error',
                ], 404)
                    ->header('Content-Type', 'application/json');

            if ($user['reset_token'] !== $token)
                return response((array) [
                    'message' => 'Invalid Token',
                    'status' => 'error',
                ], 404)
                    ->header('Content-Type', 'application/json');

            User::where('id', $user['id'])->update(['password' => password_hash($input['password'], PASSWORD_DEFAULT), 'reset_token' => NULL]);

            return response((array) [
                'message' => 'Password Reset successfully',
                'status' => 'success',
            ], 200)
                ->header('Content-Type', 'application/json');

        } catch (Exception $exc) {
            return response($exc, 500);
        }
    }
}