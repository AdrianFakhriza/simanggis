<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use App\Models\Student;
use App\Models\MealDistribution;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(): JsonResponse
    {
        $now = Carbon::now();

        $totalSekolah = School::count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalSiswa = Student::count();
        $totalDistribusi = MealDistribution::count();

        $siswaSudahMakan = MealDistribution::whereDate('meal_date', now()->toDateString())
            ->where('status', 'received')->count();

        // Statistik Minggu Ini
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

        // Statistik Bulan Ini
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

        // Statistik Tahun Ini
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

        return response()->json([
            'status' => 'success',
            'data' => [
                'total' => [
                    'sekolah' => $totalSekolah,
                    'guru' => $totalGuru,
                    'siswa' => $totalSiswa,
                    'distribusi' => $totalDistribusi,
                    'siswa_sudah_makan_hari_ini' => $siswaSudahMakan,
                ],
                'mingguan' => [
                    'labels' => $labelsMinggu,
                    'sudah' => $dataMingguSudah,
                    'belum' => $dataMingguBelum,
                ],
                'bulanan' => [
                    'labels' => $labelsBulan,
                    'sudah' => $dataBulanSudah,
                    'belum' => $dataBulanBelum,
                ],
                'tahunan' => [
                    'labels' => $labelsTahun,
                    'sudah' => $dataTahunSudah,
                    'belum' => $dataTahunBelum,
                ],
            ],
        ]);
    }
}
