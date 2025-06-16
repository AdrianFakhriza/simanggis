<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

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
        $schoolId = auth('api')->user()->school_id;

        if (!$schoolId) {
            return response()->json([
                'message' => 'User does not belong to any school.'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'lowercase', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $teacher = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'school_id' => $schoolId,
            'role' => 'guru',
        ]);

        return response()->json([
            'message' => 'Teacher added successfully!',
            'teacher' => $teacher,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $teacher = User::find($id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found.'], 404);
        }

        $authUser = auth('api')->user();

        if ($authUser->school_id !== $teacher->school_id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $teacher->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $updateData = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $teacher->update($updateData);

        return response()->json([
            'message' => 'Teacher updated successfully!',
            'teacher' => $teacher
        ]);
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
        $teacher = User::find($id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found.'], 404);
        }

        $authUser = auth('api')->user();

        if ($authUser->school_id !== $teacher->school_id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $teacher->delete();

        return response()->json(['message' => 'Teacher deleted successfully!']);
    }
}
