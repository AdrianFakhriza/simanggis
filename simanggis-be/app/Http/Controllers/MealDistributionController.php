<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\MealDistribution;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealDistributionController extends Controller
{
    public function index(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $distributions = MealDistribution::select(
            'meal_date',
            'students.class_id',
            'classes.class_name as class_name',
            'users.name as teacher_name'
        )
            ->join('students', 'meal_distributions.student_id', '=', 'students.student_id')
            ->join('classes', 'students.class_id', '=', 'classes.class_id')
            ->join('users', 'classes.teacher_id', '=', 'users.id') // join ke guru
            ->where('meal_distributions.school_id', $schoolId)
            ->when($request->start_date, fn($q) => $q->where('meal_date', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->where('meal_date', '<=', $request->end_date))
            ->groupBy('meal_date', 'students.class_id', 'classes.class_name', 'users.name')
            ->selectRaw('count(*) as total_distributions')
            ->orderByDesc('meal_date')
            ->get();


        return view('meals.index', compact('distributions'));
    }


    public function create()
    {
        $classes = Classes::with('teacher')
            ->where('school_id', Auth::user()->school_id)
            ->whereNotNull('teacher_id') // hanya kelas yang punya wali
            ->get();

        return view('meals.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,class_id',
            'meal_date' => 'required|date',
        ]);

        $schoolId = Auth::user()->school_id;

        $class = Classes::with('teacher')->findOrFail($request->class_id);
        // Pastikan kelas punya guru
        if (!$class->teacher_id) {
            return redirect()->back()->withErrors(['class_id' => 'Kelas ini belum memiliki guru.'])->withInput();
        }

        $teacherId = $class->teacher_id;

        $students = Student::where('class_id', $class->class_id)->get();

        $createdCount = 0;

        foreach ($students as $student) {
            $exists = MealDistribution::where('student_id', $student->student_id)
                ->where('meal_date', $request->meal_date)
                ->exists();

            if (!$exists) {
                MealDistribution::create([
                    'school_id'   => $schoolId,
                    'meal_date'   => $request->meal_date,
                    'student_id'  => $student->student_id,
                    'class_id'    => $class->class_id,
                    'teacher_id'  => $teacherId,
                    'status'      => 'not_received'
                ]);
                $createdCount++;
            }
        }

        return redirect()->route('meals.create')->with('success', "$createdCount distribusi makanan berhasil dibuat untuk kelas {$class->name}.");
    }

    public function show($id)
    {
        $distribution = MealDistribution::with('school')->findOrFail($id);
        return view('distributions.show', compact('distribution'));
    }

    public function edit($id)
    {
        $distribution = MealDistribution::findOrFail($id);
        $schools = School::all();
        return view('distributions.edit', compact('distribution', 'schools'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'school_id' => 'required|exists:schools,school_id',
            'meal_date' => 'required|date',
            'total_students' => 'required|integer',
            'meal_type' => 'required|string|max:50',
        ]);
        $distribution = MealDistribution::findOrFail($id);
        $distribution->update($request->all());
        return redirect()->route('distributions.index')->with('success', 'Distribution updated successfully.');
    }

    public function destroy($id)
    {
        $distribution = MealDistribution::findOrFail($id);
        $distribution->delete();
        return redirect()->route('distributions.index')->with('success', 'Distribution deleted successfully.');
    }
}
