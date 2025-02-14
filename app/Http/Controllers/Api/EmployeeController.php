<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Division;
// use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    // Get All Employees
    public function index(Request $request)
    {
        $query = Employee::with('division');

        if ($request->has('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        if ($request->has('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        $employees = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'List of divisions',
            'data' => $employees,
        ]);
    }

    // Create Employee
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'name' => 'required|string',
            'phone' => 'required|unique:employees,phone',
            'division' => 'required|uuid|exists:divisions,id',
            'position' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
        }

        $imagePath = $request->file('image')->storeAs('employees', time() . '.' . $request->file('image')->extension(), 'public');

        $employee = Employee::create([
            'id' => Str::uuid(),
            'image' => $imagePath,
            'name' => $request->name,
            'phone' => $request->phone,
            'division_id' => $request->division,
            'position' => $request->position,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Employee created successfully']);
    }

    // Update Employee
    public function update(Request $request, $id)
    {
        $employee = Employee::where('id', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'name' => 'required|string',
            'phone' => 'required|string|unique:employees,phone,' . $id,
            'division' => 'required|exists:divisions,id',
            'position' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('employees', 'public');
            $employee->image = $imagePath;
    }

        $employee->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'division_id' => $request->division,
            'position' => $request->position,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Employee updated successfully']);
    }

    // Delete Employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['status' => 'success', 'message' => 'Employee deleted successfully']);
    }
}
