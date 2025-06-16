<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MealDistribution;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MealCheckController extends Controller
{
    // Rekap absen makanan (API)
    public function index()
    {
        $teacherId = Auth::id();

        $rekap = MealDistribution::select(
                'meal_date',
                'class_id',
                DB::raw('COUNT(*) as total'),
                DB::raw("SUM(CASE WHEN status = 'received' THEN 1 ELSE 0 END) as received"),
                DB::raw("SUM(CASE WHEN status = 'not_received' THEN 1 ELSE 0 END) as not_received")
            )
            ->where('teacher_id', $teacherId)
            ->groupBy('meal_date', 'class_id')
            ->orderBy('meal_date', 'desc')
            ->with('class')
            ->get();

        return response()->json($rekap);
    }

    // Tampilkan data absen per kelas dan tanggal (API)
    public function show($class_id, $meal_date)
    {
        $students = Student::where('class_id', $class_id)->get();
        $mealDistributions = MealDistribution::where('class_id', $class_id)
            ->where('meal_date', $meal_date)
            ->get()
            ->keyBy('student_id');
        if ($students->isEmpty()) {
            return response()->json(['error' => 'No students found for this class'], 404);
        }
        return response()->json([
            'students' => $students,
            'mealDistributions' => $mealDistributions,
            'class_id' => $class_id,
            'meal_date' => $meal_date,
        ]);
    }

    // Simpan absensi makanan (API)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:classes,class_id',
            'meal_date' => 'required|date',
            'received' => 'array',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $class_id = $request->input('class_id');
        $meal_date = $request->input('meal_date');
        $received = $request->input('received', []);
        $students = Student::where('class_id', $class_id)->pluck('student_id');
        foreach ($students as $student_id) {
            MealDistribution::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'class_id' => $class_id,
                    'meal_date' => $meal_date,
                ],
                [
                    'status' => in_array($student_id, $received) ? 'received' : 'not_received',
                    'teacher_id' => Auth::id(),
                ]
            );
        }
        return response()->json(['message' => 'Absensi makanan berhasil disimpan.']);
    }
}
