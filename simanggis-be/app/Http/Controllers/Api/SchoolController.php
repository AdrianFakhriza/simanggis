<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $school = Auth::user()->school;
        return response()->json($school);
    }

    public function show($id)
    {
        $school = School::with(['students', 'students.meals', 'feedbacks'])->find($id);
        if (!$school) {
            return response()->json(['error' => 'School not found'], 404);
        }
        return response()->json($school);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = Auth::user();
        if ($user->school) {
            return response()->json(['error' => 'Anda hanya dapat menambah satu sekolah.'], 403);
        }
        $school = new School($validator->validated());
        $school->user_id = $user->id;
        $school->save();
        return response()->json(['message' => 'School created successfully.', 'school' => $school]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $school = Auth::user()->school;
        $school->update($validator->validated());
        return response()->json(['message' => 'School updated successfully.', 'school' => $school]);
    }

    public function destroy($id)
    {
        $school = School::find($id);
        if (!$school) {
            return response()->json(['error' => 'School not found'], 404);
        }
        $school->delete();
        return response()->json(['message' => 'School deleted successfully.']);
    }
}
