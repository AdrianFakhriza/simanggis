<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::where('school_id', Auth::user()->school_id)
            ->with(['classes'])
            ->get();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'nullable|exists:classes,class_id',
            'name' => 'required|string|max:255'
        ]);
        $student = Student::create([
            'school_id' => Auth::user()->school_id,
            'class_id' => $request->class_id,
            'name' => $request->name
        ]);
        return response()->json(['message' => 'Student created successfully!', 'student' => $student]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,class_id',
        ]);
        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'class_id' => $request->class_id,
            'school_id' => Auth::user()->school_id,
        ]);
        return response()->json(['message' => 'Student updated successfully!', 'student' => $student]);
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully!']);
    }

    public function show($id)
    {
        $student = Student::with('classes')->findOrFail($id);
        return response()->json($student);
    }
}
