<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $school = Auth::user()->school;
        return view('schools.index', compact('school'));
    }

    public function showEditForm()
    {
        $school = Auth::user()->school;
        return view('schools.edit', compact('school'));
    }

    public function create()
    {
        return view('schools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
        ]);

        $user = Auth::user();
        // Pastikan user hanya bisa menambah 1 sekolah
        if ($user = Auth::user()->school) {
            return redirect()->route('schools.index')->with('error', 'Anda hanya dapat menambah satu sekolah.');
        }

        // Buat sekolah dan relasikan ke user yang sedang login
        $school = new School($request->all());
        $school = $user->school;
        $school->save();

        return redirect()->route('schools.index')->with('success', 'School created successfully.');
    }

    public function show($id)
    {
        $school = School::with(['students', 'students.meals', 'feedbacks'])->findOrFail($id);
        return view('schools.show', compact('school'));
    }

    public function edit($id)
    {
        $school = School::findOrFail($id);
        return view('schools.edit', compact('school'));
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
        return redirect()->route('school.data')->with('success', 'School updated successfully.');
    }

    public function destroy($id)
    {
        // $school = School::findOrFail($id);
        // if( )
        // $school->delete();
        // return redirect()->route('schools.index')->with('success', 'School deleted successfully.');
    }
}
