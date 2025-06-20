<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use App\Models\Student;
use App\Models\MealDistribution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $schoolId = Auth::user()->school_id;
        $now = Carbon::now();
        $totalSekolah = 1; // Karena hanya 1 sekolah yang diambil
        $totalGuru = User::where('role', 'guru')->where('school_id', $schoolId)->count();
        $totalSiswa = Student::where('school_id', $schoolId)->count();
        $totalDistribusi = MealDistribution::where('school_id', $schoolId)->count();

        $siswaSudahMakan = MealDistribution::where('school_id', $schoolId)
            ->whereDate('meal_date', now()->toDateString())
            ->where('status', 'received')
            ->count();

        $startOfWeek = $now->copy()->subDays(6)->startOfDay();
        $endOfWeek = $now->copy()->endOfDay();

        $statistikMinggu = DB::table('meal_distributions')
            ->selectRaw('DATE(meal_date) as tanggal,
                         SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah,
                         SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->where('school_id', $schoolId)
            ->whereBetween('meal_date', [$startOfWeek, $endOfWeek])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labelsMinggu = $statistikMinggu->pluck('tanggal')
            ->map(fn($t) => Carbon::parse($t)->translatedFormat('d M'))
            ->toArray();
        $dataMingguSudah = $statistikMinggu->pluck('sudah')->toArray();
        $dataMingguBelum = $statistikMinggu->pluck('belum')->toArray();

        // Bulan ini
        $startOfMonth = $now->copy()->subDays(29)->startOfDay();
        $endOfMonth = $now->copy()->endOfDay();

        $statistikBulan = DB::table('meal_distributions')
            ->selectRaw('DATE(meal_date) as tanggal,
                 SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah,
                 SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->where('school_id', $schoolId)
            ->whereBetween('meal_date', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labelsBulan = $statistikBulan->pluck('tanggal')
            ->map(fn($t) => Carbon::parse($t)->format('d M'))
            ->toArray();

        $dataBulanSudah = $statistikBulan->pluck('sudah')->toArray();
        $dataBulanBelum = $statistikBulan->pluck('belum')->toArray();

        // Tahun ini
        $startOfYear = $now->copy()->startOfYear();
        $endOfYear = $now->copy()->endOfDay();

        $statistikTahun = DB::table('meal_distributions')
            ->selectRaw('MONTH(meal_date) as bulan,
                         SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah,
                         SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->where('school_id', $schoolId)
            ->whereBetween('meal_date', [$startOfYear, $endOfYear])
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulanIndo = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $labelsTahun = $statistikTahun->pluck('bulan')
            ->map(fn($b) => $bulanIndo[$b - 1])
            ->toArray();

        $dataTahunSudah = $statistikTahun->pluck('sudah')->toArray();
        $dataTahunBelum = $statistikTahun->pluck('belum')->toArray();

        return view('admin.dashboard', compact(
            'totalSekolah',
            'totalGuru',
            'totalSiswa',
            'totalDistribusi',
            'siswaSudahMakan',
            'labelsMinggu',
            'dataMingguSudah',
            'dataMingguBelum',
            'labelsBulan',
            'dataBulanSudah',
            'dataBulanBelum',
            'labelsTahun',
            'dataTahunSudah',
            'dataTahunBelum',
        ));
    }
}
