<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use App\Models\Student;
use App\Models\MealDistribution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $now = Carbon::now();
        $totalSekolah = School::count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalSiswa = Student::count();
        $totalDistribusi = MealDistribution::count();

        // Statistik siswa sudah dapat makan gratis (hari ini)
        $siswaSudahMakan = MealDistribution::whereDate('meal_date', now()->toDateString())->where('status', 'received')->count();

        // DATA STATISTIK LINE CHART START
        // Statistik minggu ini (7 hari terakhir termasuk hari ini)
        $startOfWeek = $now->copy()->subDays(6)->startOfDay();
        $endOfWeek = $now->copy()->endOfDay();

        $statistikMinggu = DB::table('meal_distributions')
            ->selectRaw('DATE(meal_date) as tanggal,
                         SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah,
                         SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->whereBetween('meal_date', [$startOfWeek, $endOfWeek])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labelsMinggu = $statistikMinggu->pluck('tanggal')
            ->map(fn($t) => Carbon::parse($t)->translatedFormat('d M'))
            ->toArray();
        $dataMingguSudah = $statistikMinggu->pluck('sudah')->toArray();
        $dataMingguBelum = $statistikMinggu->pluck('belum')->toArray();

        // Bulan ini (1 bulan terakhir berdasarkan tanggal)
        $startOfMonth = $now->copy()->subDays(29)->startOfDay();
        $endOfMonth = $now->copy()->endOfDay();

        $statistikBulan = DB::table('meal_distributions')
            ->selectRaw('DATE(meal_date) as tanggal,
                 SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah,
                 SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->whereBetween('meal_date', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labelsBulan = $statistikBulan->pluck('tanggal')
            ->map(fn($t) => Carbon::parse($t)->format('d M'))
            ->toArray();

        $dataBulanSudah = $statistikBulan->pluck('sudah')->toArray();
        $dataBulanBelum = $statistikBulan->pluck('belum')->toArray();

        // Statistik tahun ini (grouped by bulan)
        $startOfYear = $now->copy()->startOfYear();
        $endOfYear = $now->copy()->endOfDay();

        $statistikTahun = DB::table('meal_distributions')
            ->selectRaw('MONTH(meal_date) as bulan,
                         SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah,
                         SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
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
        // DATA STATISTIK LINE CHART END

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
