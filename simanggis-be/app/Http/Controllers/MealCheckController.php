<?php

namespace App\Http\Controllers;

use App\Models\MealDistribution;
use App\Models\Student; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MealCheckController extends Controller
{
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
            ->with('class') // Pastikan relasi ke model Class
            ->get();

        return view('meal_check.index', compact('rekap'));
    }

    // Tampilkan form absen
    public function show($class_id, $meal_date)
    {
        $students = Student::where('class_id', $class_id)->get();
        $mealDistributions = MealDistribution::where('class_id', $class_id)
            ->where('meal_date', $meal_date)
            ->get()
            ->keyBy('student_id');

        return view('meal_check.absen', compact('students', 'mealDistributions', 'class_id', 'meal_date'));
    }

    // Simpan absensi
    public function store(Request $request)
    {
        $class_id = $request->input('class_id');
        $meal_date = $request->input('meal_date');
        $received = $request->input('received', []); // array student_id yang menerima

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

        return redirect()->route('meal.check.index')->with('success', 'Absensi makanan berhasil disimpan.');
    }
}
