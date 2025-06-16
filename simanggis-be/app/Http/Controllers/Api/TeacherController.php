<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class TeacherController extends Controller
{
    public function index()
    {
        $schoolId = Auth::user()->school_id;
        $teachers = User::where('school_id', $schoolId)
            ->where('role', 'guru')
            ->get();
        return response()->json($teachers);
    }

    public function store(Request $request)
    {
        $school = Auth::user()->school;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules::Password(), 'min:8'],
        ]);
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
        $teacher = User::findOrFail($id);
        if (Auth::user()->school_id != $teacher->school_id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $teacher->id],
            'password' => ['nullable', 'confirmed', Rules::Password(), 'min:8'],
        ]);
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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Teacher deleted successfully!']);
    }
}
