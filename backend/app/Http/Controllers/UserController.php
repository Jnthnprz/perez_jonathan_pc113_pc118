<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\CredentialsMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
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
    
    // Upload document with validation
    public function uploadDocument(Request $request)
    {
        // Validate uploaded document (optional validation)
        $request->validate([
            'document' => 'required|file|mimes:pdf,jpeg,png|max:2048', // max size: 2MB
        ]);
        
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $path = $file->store('documents', 'public'); // Save to storage/app/public/documents
            
            return response()->json([
                'message' => 'File uploaded successfully.',
                'file_url' => asset('storage/' . $path), // Public URL for the uploaded file
            ]);
        }
    
        return response()->json(['message' => 'No file uploaded.'], 400);
    }

    public function index(Request $request)
    {
        // Query for all users
        $query = User::query();

        // Handle the search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('f_name', 'LIKE', "%{$search}%")
                  ->orWhere('l_name', 'LIKE', "%{$search}%")
                  ->orWhere('m_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('role', 'LIKE', "%{$search}%");
        }

        // Get the users
        $users = $query->get();

        return response()->json($users);
    }

    public function create(Request $request)
    {
        // Validate the incoming data
        $validateData = $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'm_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
        ]);

        // Create a new user
        $user = User::create($validateData);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        // Validate the updated data
        $validateData = $request->validate([
            'f_name' => 'string',
            'l_name' => 'string',
            'm_name' => 'string',
            'email' => 'email',
            'role' => 'string',
        ]);

        // Update the user
        $user->update($validateData);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy($id)
{
    $user = User::find($id);
    if (is_null($user)) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->delete();

    return response()->json(['message' => 'User deleted successfully']);
}

    public function show($id)
    {
        // Find the user by ID
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        return response()->json($user);
    }
public function store(Request $request)
{
    $validate = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'required',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create($validate);
    Mail::to($user->email)->send(new CredentialsMail($user->id, $user->name));

    return response()->json(['message' => 'User created successfully'], 201);
}
}


