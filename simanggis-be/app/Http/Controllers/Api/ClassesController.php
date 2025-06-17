<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    public function index()
    {
        $school_id = Auth::user()->school_id;
        $classes = Classes::with('teacher')
            ->where('school_id', $school_id)
            ->get();
        return response()->json($classes);
    }

    public function store(Request $request)
    {
        $school_id = Auth::user()->school_id;
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required|exists:users,id',
            'class_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $class = Classes::create([
            'school_id' => $school_id,
            'teacher_id' => $request->teacher_id,
            'class_name' => $request->class_name,
            'description' => $request->description,
        ]);
        return response()->json(['message' => 'Class added successfully!', 'class' => $class]);
    }

    public function show($id)
    {
        $class = Classes::with('school', 'students', 'teacher')->find($id);
        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }
        return response()->json($class);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'class_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $class = Classes::find($id);
        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }
        $class->update($validator->validated());
        return response()->json(['message' => "Class '{$class->class_name}' updated successfully!", 'class' => $class]);
    }

    public function destroy($id)
    {
        $class = Classes::find($id);
        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }
        $class->delete();
        return response()->json(['message' => 'Class deleted successfully!']);
    }
}
