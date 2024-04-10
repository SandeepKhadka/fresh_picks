<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $response = [
                'user' => $user,
                'message' => 'Successfully Logged In',
                'status' => true
            ];
            return response()->json($response, 200);
        }

        $response = ['message' => 'Incorrect email or password', 'status' => false];
        return response()->json($response, 401);
    }


    public function signup(Request $req)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string'
        ];

        // Validate the request data
        $validator = Validator::make($req->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response = [
                'message' => 'Validation failed',
                'errors' => $errors,
                'status' => false
            ];
            return response()->json($response, 422);
        }

        // Create a new user
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password); // You should hash the password before saving it
        $user->phone = $req->phone;

        // Try saving the user
        try {
            $user->save();
        } catch (\Exception $e) {
            $response = [
                'message' => 'User registration failed',
                'error' => $e->getMessage(),
                'status' => false
            ];
            return response()->json($response, 500);
        }

        // User registration successful
        $response = [
            'user' => $user,
            'message' => 'User registered successfully',
            'status' => true
        ];

        return response()->json($response, 201);
    }

    public function getUserDetails(Request $request)
    {
    }

    public function updateUserDetails(Request $request, $user_id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $user_id, // Ignore unique constraint for the current user
            'password' => 'string|min:6',
            'phone' => 'nullable|string'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors], 422);
        }

        // Get the authenticated user
        $user = User::find($user_id);

        // // Check if the authenticated user matches the requested user
        // if ($user->id != $user_id) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        // Update user details
        $user->fill($request->only(['name', 'email', 'password', 'phone']));

        // Save the updated user
        try {
            $user->save();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update user details', 'error' => $e->getMessage()], 500);
        }

        // User details updated successfully
        return response()->json(['user' => $user, 'message' => 'User details updated successfully'], 200);
    }
}
