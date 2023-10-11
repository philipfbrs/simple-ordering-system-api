<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    // CREATE User
    //
    public function createUser(Request $request)
    {
        try {
            $input = $request->only('first_name', 'last_name', 'username', 'email', 'password');

            $isEmailExist = User::where('email', $input['email'])->withTrashed()->first();

            if ($isEmailExist)
                return response((array) 
                    [
                        'message' => 'Email is already taken',
                        'status' => "error"
                    ], 404);

            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);

            $create = User::create($input);
            return response((array) 
                [
                    'message' => 'User: ' . $input['username'] . ' Created Successfully',
                    'status' => "success"
                ], 201);
        } catch (Exception $err) {
            return response((array) 
                [
                    'message' => 'Internal Server Error',
                    'status' => "error"
                ], 500);
        }
    }

    //
    // UPDATE User
    //

    public function updateUser(Request $request)
    {
        try {

            $input = $request->only('first_name', 'last_name', 'username', 'email', 'password');

            $id = $request->route('id');

            $isDataExist = User::where('id', $id)->first();

            if (!$isDataExist)
                return response((array) 
                    [
                        'message' => 'User does not exist',
                        'status' => "error"
                    ], 404);

            if (!empty($input['email'])) {
                $isEmailExist = User::where(function ($query) use ($input, $id) {
                    $query = $query->where('email', $input['email'])->where('id', '!=', $id);
                })->withTrashed()->first();

                if ($isEmailExist)
                    return response((array) 
                        [
                            'message' => 'Email is already taken',
                            'status' => "error"
                        ], 404);
            }



            $update = User::where('id', $id)->update($input);

            return response((array) 
                [
                    'message' => 'User: ' . $id . ' Updated Successfully',
                    'status' => "success"
                ], 200);
        } catch (Exception $err) {
            return response((array) 
                [
                    'message' => 'Internal Server Error',
                    'status' => "error"
                ], 500);
        }
    }

    //
    // DELETE User
    //

    public function deleteUser(Request $request)
    {
        try {
            $id = $request->route('id');

            $isDataExist = User::where('id', $id)->first();

            if (!$isDataExist)
                return response((array) 
                    [
                        'message' => 'User does not exist',
                        'status' => "error"
                    ], 404);

            $delete = $isDataExist->delete();
            return response((array) 
                [
                    'message' => 'User: ' . $id . ' Deleted Successfully',
                    'status' => "success"
                ], 200);

        } catch (Exception $err) {
            return response((array) 
                [
                    'message' => 'Internal Server Error',
                    'status' => "error"
                ], 500);
        }
    }

    //
    // GET User
    //

    public function getUser(Request $request)
    {
        try {
            $id = $request->route('id');

            $isDataExist = User::select('id', 'email', 'first_name', 'last_name')->where('id', $id)->first();

            if (!$isDataExist)
                return response((array) 
                    [
                        'message' => 'User does not exist',
                        'status' => "error"
                    ], 404);


            return response((array) [
                'data' => $isDataExist,
                'message' => 'success',
            ], 200)
                ->header('Content-Type', 'application/json');
        } catch (Exception $err) {
            return response((array) 
                [
                    'message' => 'Internal Server Error',
                    'status' => "error"
                ], 500);
        }
    }
}