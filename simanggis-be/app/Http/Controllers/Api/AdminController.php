<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use App\Models\Student;
use App\Models\MealDistribution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Contoh: Ambil data dashboard admin
    public function dashboard()
    {
        $now = Carbon::now();
        $totalSekolah = School::count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalSiswa = Student::count();
        $totalDistribusi = MealDistribution::count();

        $siswaSudahMakan = MealDistribution::whereDate('meal_date', now()->toDateString())->where('status', 'received')->count();

        $startOfWeek = $now->copy()->subDays(6)->startOfDay();
        $endOfWeek = $now->copy()->endOfDay();
        $statistikMinggu = DB::table('meal_distributions')
            ->selectRaw('DATE(meal_date) as tanggal, SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah, SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->whereBetween('meal_date', [$startOfWeek, $endOfWeek])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $labelsMinggu = $statistikMinggu->pluck('tanggal')->map(fn($t) => Carbon::parse($t)->translatedFormat('d M'))->toArray();
        $dataMingguSudah = $statistikMinggu->pluck('sudah')->toArray();
        $dataMingguBelum = $statistikMinggu->pluck('belum')->toArray();

        $startOfMonth = $now->copy()->subDays(29)->startOfDay();
        $endOfMonth = $now->copy()->endOfDay();
        $statistikBulan = DB::table('meal_distributions')
            ->selectRaw('DATE(meal_date) as tanggal, SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah, SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->whereBetween('meal_date', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $labelsBulan = $statistikBulan->pluck('tanggal')->map(fn($t) => Carbon::parse($t)->format('d M'))->toArray();
        $dataBulanSudah = $statistikBulan->pluck('sudah')->toArray();
        $dataBulanBelum = $statistikBulan->pluck('belum')->toArray();

        $startOfYear = $now->copy()->startOfYear();
        $endOfYear = $now->copy()->endOfDay();
        $statistikTahun = DB::table('meal_distributions')
            ->selectRaw('MONTH(meal_date) as bulan, SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as sudah, SUM(CASE WHEN status = "not_received" THEN 1 ELSE 0 END) as belum')
            ->whereBetween('meal_date', [$startOfYear, $endOfYear])
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        $bulanIndo = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $labelsTahun = $statistikTahun->pluck('bulan')->map(fn($b) => $bulanIndo[$b - 1])->toArray();
        $dataTahunSudah = $statistikTahun->pluck('sudah')->toArray();
        $dataTahunBelum = $statistikTahun->pluck('belum')->toArray();

        return response()->json([
            'totalSekolah' => $totalSekolah,
            'totalGuru' => $totalGuru,
            'totalSiswa' => $totalSiswa,
            'totalDistribusi' => $totalDistribusi,
            'siswaSudahMakan' => $siswaSudahMakan,
            'labelsMinggu' => $labelsMinggu,
            'dataMingguSudah' => $dataMingguSudah,
            'dataMingguBelum' => $dataMingguBelum,
            'labelsBulan' => $labelsBulan,
            'dataBulanSudah' => $dataBulanSudah,
            'dataBulanBelum' => $dataBulanBelum,
            'labelsTahun' => $labelsTahun,
            'dataTahunSudah' => $dataTahunSudah,
            'dataTahunBelum' => $dataTahunBelum,
        ]);
    }
}
