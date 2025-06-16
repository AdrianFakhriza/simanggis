<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
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
        $school = School::with(['students', 'students.meals', 'feedbacks'])->findOrFail($id);
        return response()->json($school);
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
        ]);

        $user = Auth::user();
        if ($user->school) {
            return response()->json(['error' => 'Anda hanya dapat menambah satu sekolah.'], 403);
        }

        $school = new School($request->all());
        $school->user_id = $user->id;
        $school->save();

        return response()->json(['message' => 'School created successfully.', 'school' => $school]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|numeric',
        ]);

        $school = Auth::user()->school;
        $school->update($request->all());
        return response()->json(['message' => 'School updated successfully.', 'school' => $school]);
    }

    public function destroy($id)
    {
        $school = School::findOrFail($id);
        $school->delete();
        return response()->json(['message' => 'School deleted successfully.']);
    }
}
