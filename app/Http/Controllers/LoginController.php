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

    public function getUserDetails(Request $request){
        
    }

}
