<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         $request->headers->set('Accept', 'application/json');
    //         return $next($request);
    //     });
    // }

    public function create(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students',
            'phone_number' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
        ]);

        // Create a new student record
        $student = Student::create($validatedData);

        // Return a JSON response
        return response()->json(['message' => 'Student created successfully', 'data' => $student], 201);
    }

    // read all records
    public function read(){
        $student = Student::all();

        return response() -> json(['data' => $student], 200);
    }

    // update data
    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $id, 
            'phone_number' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
        ]);

        $student = Student::findOrFail($id);

        $student->update($validatedData);

        return response() -> json(['message' => 'Student updated successfully', 'data' => $student], 200);
    }

    // delete record
    public function delete(Request $request, $id){
        $student = student::findOrFail($id);

        $student->delete();

        return response() -> json(['message' => 'Student deleted successfully'], 200);
    }
}
