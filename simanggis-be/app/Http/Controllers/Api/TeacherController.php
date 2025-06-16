<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        $schoolId = auth('api')->user()->school_id;

        $teachers = User::where('school_id', $schoolId)
            ->where('role', 'guru')
            ->get();

        return response()->json($teachers);
    }

    public function store(Request $request)
    {
        $school = Auth::user()->school;
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $teacher = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $school->school_id,
            'role' => 'guru',
        ]);
        return response()->json(['message' => 'Teacher added successfully!', 'teacher' => $teacher]);
    }

    public function update(Request $request, $id)
    {
        $teacher = User::find($id);
        if (!$teacher) {
            return response()->json(['error' => 'Teacher not found'], 404);
        }
        if (Auth::user()->school_id != $teacher->school_id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $teacher->id],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $teacher->update($data);
        return response()->json(['message' => 'Teacher updated successfully!', 'teacher' => $teacher]);
    }

    public function show($id)
    {
        $authUser = auth('api')->user();

        $teacher = User::where('id', $id)
            ->where('role', 'guru')
            ->where('school_id', $authUser->school_id)
            ->first();

        if (!$teacher) {
            return response()->json([
                'message' => 'Teacher not found or unauthorized.'
            ], 404);
        }

        return response()->json($teacher);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Teacher not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'Teacher deleted successfully!']);
    }
}
