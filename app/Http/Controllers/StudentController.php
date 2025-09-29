<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  public function index(Request $request)
{
    $search = $request->input('search');
    
    $students = Student::when($search, function($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('email', 'like', "%{$search}%")
                     ->orWhere('phone', 'like', "%{$search}%")
                     ->orWhere('course', 'like', "%{$search}%");
    })->get();
    
    return view('students.index', compact('students', 'search'));
}

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'phone' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required|date',
            'course' => 'required'
        ]);

        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,'.$student->id,
            'phone' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required|date',
            'course' => 'required'
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}