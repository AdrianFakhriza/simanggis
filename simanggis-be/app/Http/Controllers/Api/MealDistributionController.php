<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\MealDistribution;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            ->join('users', 'classes.teacher_id', '=', 'users.id')
            ->where('meal_distributions.school_id', $schoolId)
            ->when($request->start_date, fn($q) => $q->where('meal_date', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->where('meal_date', '<=', $request->end_date))
            ->groupBy('meal_date', 'students.class_id', 'classes.class_name', 'users.name')
            ->selectRaw('count(*) as total_distributions')
            ->orderByDesc('meal_date')
            ->get();
        return response()->json($distributions);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:classes,class_id',
            'meal_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $schoolId = Auth::user()->school_id;
        $class = Classes::with('teacher')->find($request->class_id);
        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }
        if (!$class->teacher_id) {
            return response()->json(['error' => 'Kelas ini belum memiliki guru.'], 422);
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
        return response()->json(['message' => "$createdCount distribusi makanan berhasil dibuat untuk kelas {$class->class_name}."]);
    }

    public function show($id)
    {
        $distribution = MealDistribution::with('school')->find($id);
        if (!$distribution) {
            return response()->json(['error' => 'Distribution not found'], 404);
        }
        return response()->json($distribution);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'school_id' => 'required|exists:schools,school_id',
            'meal_date' => 'required|date',
            'total_students' => 'required|integer',
            'meal_type' => 'required|string|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $distribution = MealDistribution::find($id);
        if (!$distribution) {
            return response()->json(['error' => 'Distribution not found'], 404);
        }
        $distribution->update($validator->validated());
        return response()->json(['message' => 'Distribution updated successfully.', 'distribution' => $distribution]);
    }

    public function destroy($id)
    {
        $distribution = MealDistribution::find($id);
        if (!$distribution) {
            return response()->json(['error' => 'Distribution not found'], 404);
        }
        $distribution->delete();
        return response()->json(['message' => 'Distribution deleted successfully.']);
    }
}
