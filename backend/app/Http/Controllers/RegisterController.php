<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
//     public function register(Request $request)
// {
//     $validated = $request->validate([
//         'firstname' => 'required|string|max:255',
//         'lastname' => 'required|string|max:255',
//         'email' => 'required|email|unique:users,email',
//         'password' => 'required|min:6',
//     ]);

//     $user = User::create([
//         'name' => $validated['firstname'] . ' ' . $validated['lastname'],
//         'email' => $validated['email'],
//         'password' => bcrypt($validated['password']),
//         'role' => 'customer'
//     ]);

//     // Automatically log the user in (generate token)
//     if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
//         throw ValidationException::withMessages([
//             'email' => ['The provided credentials are incorrect.'],
//         ]);
//     }

//     $user = Auth::user();
//     $token = $user->createToken('auth_token')->plainTextToken;

//     return response()->json([
//         'message' => 'Registered and logged in successfully.',
//         'token' => $token,
//         'user' => $user,
//         'role' => $user->role
//     ]);
// }
public function register(Request $request)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->firstname . ' ' . $request->lastname,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 2, // Assign an integer value for the role (e.g., 2 for 'customer')
    ]);
    

    return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
}
}    