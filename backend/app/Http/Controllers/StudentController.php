<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Student::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('f_name', 'LIKE', "%{$search}%")
                  ->orWhere('l_name', 'LIKE', "%{$search}%")
                  ->orWhere('m_name', 'LIKE', "%{$search}%")
                  ->orWhere('age', 'LIKE', "%{$search}%")
                  ->orWhere('contact_number', 'LIKE', "%{$search}%");
        }

        $students = $query->get();

        return response()->json($students);
    }
        public function create(Request $request)
    {
        $validateData = $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'm_name' => 'required',
            'age' => 'required',
            'contact_number' => 'required',
        ]);
        $student = Student::create($validateData);
        return response()->json([
        'message' => 'Student created successfully',
        'student' => $student,
    ], 201);
}
        public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (is_null($student)) {
            return response()->json([
                'message' => 'Student not found',
            ], 404);
        }
        $validateData = $request->validate([
            'f_name' => 'string',
            'l_name' => 'string',
            'm_name' => 'string',
            'age' => 'string',
            'contact_number' => 'string',
        ]);
        $student->update($validateData);
        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student,
        ]);
}

        public function destroy($id)
    {
        $student = Student::find($id);
        if (is_null($student)) {
            return response()->json([
                'message' => 'Student not found',
            ], 404);
        }
        $student->delete();
        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
}
public function show($id)
    {
        $student = Student::find($id);
        if (is_null($student)) {
            return response()->json([
                'message' => 'Student not found',
            ], 404);
        }
        return response()->json($student);
    }
}