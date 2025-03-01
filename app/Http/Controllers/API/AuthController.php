<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // deri mag-check sa user credentialsssss
        $user = User::where('email', $request->email)->first();
        // deri gi-check ang password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        
        $token = Str::random(70);
        // $user->api_token = hash('sha256', $token);
        // $user->save();
         $user->update(['api_token' => $token]);

        return response()->json([
            'token' => $token,
            'user' => $user->only(['id','name','email'])
        ]);
    } 
}