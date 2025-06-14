<!-- resources/views/distributions/index.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <nav class="flex text-sm text-gray-600" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-600 hover:underline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <span class="mx-2 text-gray-400">/</span>
                </li>
                <li class="inline-flex items-center text-gray-500">
                    Data Distribusi
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Daftar Siswa</h2>
    </div>
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('meals.create') }}"
                class="inline-flex items-center px-4 py-2 text-white transition duration-200 bg-blue-600 rounded-md hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 4v16m8-8H4" />
                </svg>
                Tambah Jadwal
            </a>

            <form method="GET" action="{{ route('meals') }}" class="flex items-end gap-4">
                <div>
                    <label for="start_date" class="block mb-1 text-sm font-semibold text-gray-700">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                        class="p-2 border border-gray-300 rounded-md w-36 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="end_date" class="block mb-1 text-sm font-semibold text-gray-700">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                        class="p-2 border border-gray-300 rounded-md w-36 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <button type="submit"
                    class="px-4 py-2 text-white transition duration-200 bg-blue-600 rounded-md hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>

        <div class="p-4 overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-left table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Nama Kelas</th>
                        <th class="px-4 py-2 border">Total Distribusi</th>
                        <th class="px-4 py-2 border">Tanggal Distribusi</th>
                        <th class="px-4 py-2 border">Guru Penanggung Jawab</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($distributions as $row)
                        <tr>
                            <td class="px-4 py-2 border">{{ $row->class_name }}</td>
                            <td class="px-4 py-2 border">{{ $row->total_distributions }}</td>
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($row->meal_date)->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-4 py-2 border">{{ $row->teacher_name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 italic text-center text-gray-500 border">Tidak ada distribusi
                                ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
