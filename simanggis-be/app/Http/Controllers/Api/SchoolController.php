<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $school = School::with(['students', 'students.meals', 'feedbacks'])->find($id);
        if (!$school) {
            return response()->json(['error' => 'School not found'], 404);
        }
        return response()->json($school);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = Auth::user();
        if ($user->school) {
            return response()->json(['error' => 'Anda hanya dapat menambah satu sekolah.'], 403);
        }
        $school = new School($validator->validated());
        $school->user_id = $user->id;
        $school->save();
        return response()->json(['message' => 'School created successfully.', 'school' => $school]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $school = Auth::user()->school;
        $school->update($validator->validated());
        return response()->json(['message' => 'School updated successfully.', 'school' => $school]);
    }

    public function destroy($id)
    {
        $school = School::find($id);
        if (!$school) {
            return response()->json(['error' => 'School not found'], 404);
        }
        $school->delete();
        return response()->json(['message' => 'School deleted successfully.']);
    }

    public function publicIndex()
    {
        $schools = \App\Models\School::with(['users', 'classes', 'students', 'feedback', 'mealDistributions'])->get();
        foreach ($schools as $school) {
            $school->siswaSudahMakan = $school->mealDistributions()->whereDate('meal_date', now()->toDateString())->where('status', 'received')->count();
            $school->siswaBelumMakan = $school->mealDistributions()->whereDate('meal_date', now()->toDateString())->where('status', 'not_received')->count();

            $startOfWeek = now()->copy()->subDays(6)->startOfDay();
            $endOfWeek = now()->copy()->endOfDay();
            $statistikMinggu = $school->mealDistributions()
                ->selectRaw('DATE(meal_date) as tanggal, SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah, SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
                ->whereBetween('meal_date', [$startOfWeek, $endOfWeek])
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();
            $school->labelsMinggu = $statistikMinggu->pluck('tanggal')->map(fn($t) => \Carbon\Carbon::parse($t)->translatedFormat('d M'))->toArray();
            $school->dataMingguSudah = $statistikMinggu->pluck('sudah')->toArray();
            $school->dataMingguBelum = $statistikMinggu->pluck('belum')->toArray();

            $startOfMonth = now()->copy()->subDays(29)->startOfDay();
            $endOfMonth = now()->copy()->endOfDay();
            $statistikBulan = $school->mealDistributions()
                ->selectRaw('DATE(meal_date) as tanggal, SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah, SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
                ->whereBetween('meal_date', [$startOfMonth, $endOfMonth])
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();
            $school->labelsBulan = $statistikBulan->pluck('tanggal')->map(fn($t) => \Carbon\Carbon::parse($t)->format('d M'))->toArray();
            $school->dataBulanSudah = $statistikBulan->pluck('sudah')->toArray();
            $school->dataBulanBelum = $statistikBulan->pluck('belum')->toArray();

            $startOfYear = now()->copy()->startOfYear();
            $endOfYear = now()->copy()->endOfDay();
            $statistikTahun = $school->mealDistributions()
                ->selectRaw('MONTH(meal_date) as bulan, SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah, SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
                ->whereBetween('meal_date', [$startOfYear, $endOfYear])
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();
            $bulanIndo = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            $school->labelsTahun = $statistikTahun->pluck('bulan')->map(fn($b) => $bulanIndo[$b - 1])->toArray();
            $school->dataTahunSudah = $statistikTahun->pluck('sudah')->toArray();
            $school->dataTahunBelum = $statistikTahun->pluck('belum')->toArray();
        }
        return response()->json([
            'success' => true,
            'data' => $schools
        ]);
    }

    public function publicShow($id)
    {
        $school = \App\Models\School::with(['users', 'classes', 'students', 'feedback', 'mealDistributions'])->findOrFail($id);

        $school->siswaSudahMakan = $school->mealDistributions()->whereDate('meal_date', now()->toDateString())->where('status', 'received')->count();
        $school->siswaBelumMakan = $school->mealDistributions()->whereDate('meal_date', now()->toDateString())->where('status', 'not_received')->count();

        $startOfWeek = now()->copy()->subDays(6)->startOfDay();
        $endOfWeek = now()->copy()->endOfDay();
        $statistikMinggu = $school->mealDistributions()
            ->selectRaw('DATE(meal_date) as tanggal, SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah, SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->whereBetween('meal_date', [$startOfWeek, $endOfWeek])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $school->labelsMinggu = $statistikMinggu->pluck('tanggal')->map(fn($t) => \Carbon\Carbon::parse($t)->translatedFormat('d M'))->toArray();
        $school->dataMingguSudah = $statistikMinggu->pluck('sudah')->toArray();
        $school->dataMingguBelum = $statistikMinggu->pluck('belum')->toArray();

        $startOfMonth = now()->copy()->subDays(29)->startOfDay();
        $endOfMonth = now()->copy()->endOfDay();
        $statistikBulan = $school->mealDistributions()
            ->selectRaw('DATE(meal_date) as tanggal, SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah, SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->whereBetween('meal_date', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $school->labelsBulan = $statistikBulan->pluck('tanggal')->map(fn($t) => \Carbon\Carbon::parse($t)->format('d M'))->toArray();
        $school->dataBulanSudah = $statistikBulan->pluck('sudah')->toArray();
        $school->dataBulanBelum = $statistikBulan->pluck('belum')->toArray();

        $startOfYear = now()->copy()->startOfYear();
        $endOfYear = now()->copy()->endOfDay();
        $statistikTahun = $school->mealDistributions()
            ->selectRaw('MONTH(meal_date) as bulan, SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah, SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->whereBetween('meal_date', [$startOfYear, $endOfYear])
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        $bulanIndo = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $school->labelsTahun = $statistikTahun->pluck('bulan')->map(fn($b) => $bulanIndo[$b - 1])->toArray();
        $school->dataTahunSudah = $statistikTahun->pluck('sudah')->toArray();
        $school->dataTahunBelum = $statistikTahun->pluck('belum')->toArray();

        return response()->json([
            'success' => true,
            'data' => $school
        ]);
    }
}
