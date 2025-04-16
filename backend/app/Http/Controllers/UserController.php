<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function current_user()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role ?? 'N/A',
        ], 200);
    }
    
    public function uploadDocument(Request $request)
    {
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $path = $file->store('documents', 'public'); // saves in storage/app/public/documents
    
            return response()->json([
                'message' => 'File uploaded successfully.',
                'file_url' => asset('storage/' . $path),
            ]);
        }
    
        return response()->json(['message' => 'No file uploaded.'], 400);
    }
    
}