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

    // read a record
    public function read(){
        $student = Student::all();

        return response() -> json(['data' => $student], 200);
    }

}
