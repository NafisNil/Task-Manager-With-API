<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
class AuthController extends Controller
{
    //
    public function login(Request $request){
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($validate)) {
            # code...
            return response()->json([
                'message' => 'Login information invalid'
            ], 401);
        }

        $user = User::where('email', $validate['email'])->first();

        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }


    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create($validated);
        return response()->json([
            'data' => $user,
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer'
        ], 201);
    }
}
