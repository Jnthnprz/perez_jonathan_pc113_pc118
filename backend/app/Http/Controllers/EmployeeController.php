<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('f_name', 'LIKE', "%{$search}%")
                  ->orWhere('l_name', 'LIKE', "%{$search}%")
                  ->orWhere('m_name', 'LIKE', "%{$search}%")
                  ->orWhere('age', 'LIKE', "%{$search}%")
                  ->orWhere('contact_number', 'LIKE', "%{$search}%");
        }

        $employees = $query->get();
        return response()->json($employees);
    }

    // public function store(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'f_name' => 'required',
    //         'l_name' => 'required',
    //         'm_name' => 'required',
    //         'age' => 'required|numeric|min:1|max:150',
    //         'contact_number' => 'required|string|max:15',
    //     ]);

    //     $employee = Employee::create($validateData);

    //     return response()->json([
    //         'message' => 'Employee created successfully',
    //         'employee' => $employee,
    //     ], 201);
    // }

    public function show($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        return response()->json($employee);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validateData = $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'm_name' => 'required',
            'age' => 'required|numeric|min:1|max:150',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'contact_number' => 'required|string|max:15',
        ]);

        $employee->update($validateData);

        return response()->json([
            'message' => 'Employee updated successfully',
            'employee' => $employee,
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
    public function create(Request $request)
    {
        $validateData = $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'm_name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:8', 
            'age' => 'required|numeric|min:1|max:150',
            'contact_number' => 'required|string|max:15',
        ]);

        $employee = Employee::create($validateData);

        return response()->json([
            'message' => 'Employee created successfully',
            'employee' => $employee,
        ], 201);
    }
}
