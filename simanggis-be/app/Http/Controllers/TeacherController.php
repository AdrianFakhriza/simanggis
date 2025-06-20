<?php

namespace App\Http\Controllers;

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
        return view('teachers.index', [
            'teachers' => $teachers,
        ]);
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        // Logic to store teacher data
        $school = Auth::user()->school;
        // Validate and save the teacher data

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'min:8'],
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $school->school_id,
            'role' => 'guru',
        ]);
        // Redirect or return a response
        return redirect()->route('teachers')->with('success', 'Teacher added successfully!');
    }

    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        if (Auth::user()->school_id != $teacher->school_id) {
            return redirect()->route('teachers')->with('error', 'You Are My Fire.');
        }
        // Logic to show the edit form for a specific teacher
        return view('teachers.edit', [
            'teacher' => $teacher,
        ]);
    }

    public function update(Request $request, $id)
    {
        $teacher = User::findOrFail($id);

        if (Auth::user()->school_id != $teacher->school_id) {
            return redirect()->route('teachers')->with('error', 'You Are My Fire.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $teacher->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults(), 'min:8'],
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

        return redirect()->route('teachers')->with('success', 'Teacher updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('teachers')->with('success', 'Teacher deleted successfully!');
    }
}
