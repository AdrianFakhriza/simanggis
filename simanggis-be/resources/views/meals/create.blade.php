@extends('layouts.admin') {{-- Menggunakan layout yang kamu buat --}}

@section('title', 'Tambah Distribusi Makanan')

@section('content')
<div class="mb-6">
        <nav class="flex text-sm text-gray-600" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-600 hover:underline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <span class="mx-2 text-gray-400">/</span>
                </li>
                <li class="inline-flex items-center text-gray-500">
                     <a href="{{ route('meals') }}" class="inline-flex items-center text-blue-600 hover:underline">
                    Data Distribusi
                    </a>
                </li>
                <li>
                    <span class="mx-2 text-gray-400">/</span>
                </li>
                <li class="inline-flex items-center text-gray-500">
                    Tambah Distirbusi
                </li>
            </ol>
        </nav>
    </div>
<div class="bg-white p-6 rounded shadow-md w-full max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4 text-blue-600">Tambah Jadwal Distribusi Makanan</h2>

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('meals.store') }}" method="POST">
        @csrf

        <!-- Pilih Kelas -->
        <div class="mb-4">
            <label for="class_id" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
            <select id="class_id" name="class_id" required class="mt-1 block w-full rounded border-gray-300 shadow-sm py-2">
                <option value="">  Pilih Kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->class_id }}">{{ $class->class_name }} (Wali: {{ $class->teacher->name ?? 'Belum Ada' }})</option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal Distribusi -->
        <div class="mb-4">
            <label for="meal_date" class="block text-sm font-medium text-gray-700">Tanggal Distribusi</label>
            <input type="date" id="meal_date" name="meal_date" required class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Jadwalkan</button>
        </div>
    </form>
</div>
@endsection
