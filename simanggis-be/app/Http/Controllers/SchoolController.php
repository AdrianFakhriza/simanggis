<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        // Ambil sekolah milik user yang sedang login beserta relasi
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
        $school = \App\Models\School::with(['users', 'classes', 'students', 'feedback', 'mealDistributions'])->findOrFail($id);
        return view('sekolah.show', compact('school'));
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

    // Halaman publik: daftar semua sekolah dan statistik
    public function publicIndex()
    {
        $schools = \App\Models\School::with(['users', 'classes', 'students', 'feedback', 'mealDistributions'])->whereNull('deleted_at')->get();
        foreach ($schools as $school) {
            // Statistik siswa sudah/belum makan per sekolah (hari ini)
            $school->siswaSudahMakan = $school->mealDistributions()->whereDate('meal_date', now()->toDateString())->where('status', 'received')->count();
            $school->siswaBelumMakan = $school->mealDistributions()->whereDate('meal_date', now()->toDateString())->where('status', 'not_received')->count();

            // Statistik minggu ini (7 hari terakhir)
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

            // Statistik bulan ini (30 hari terakhir)
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

            // Statistik tahun ini (per bulan)
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
        return view('sekolah.index', compact('schools'));
    }

    // Halaman publik: detail sekolah
    public function publicShow($id)
    {
        $school = \App\Models\School::with(['users', 'classes', 'students', 'feedback', 'mealDistributions'])->findOrFail($id);
        // Statistik siswa sudah/belum makan per sekolah (hari ini)
        $school->siswaSudahMakan = $school->mealDistributions()->whereDate('meal_date', now()->toDateString())->where('status', 'received')->count();
        $school->siswaBelumMakan = $school->mealDistributions()->whereDate('meal_date', now()->toDateString())->where('status', 'not_received')->count();

        // Statistik minggu ini (7 hari terakhir)
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

        // Statistik bulan ini (30 hari terakhir)
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

        // Statistik tahun ini (per bulan)
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

        return view('sekolah.show', compact('school'));
    }
}
