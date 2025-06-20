@extends('layouts.admin')

@section('title', 'Detail Siswa')

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
                     <a href="{{ route('students') }}" class="inline-flex items-center text-blue-600 hover:underline">
                    Data Siswa
                    </a>
                </li>
                <li>
                    <span class="mx-2 text-gray-400">/</span>
                </li>
                <li class="inline-flex items-center text-gray-500">
                    Detail Siswa
                </li>
            </ol>
        </nav>
    </div>
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-6">Detail Siswa</h2>
    <div class="mb-4">
        <strong>Nama:</strong> {{ $student->name }}
    </div>
    <div class="mb-4">
        <strong>NISN:</strong> {{ $student->nisn }}
    </div>
    <div class="mb-4">
        <strong>Jenis Kelamin:</strong> {{ $student->gender }}
    </div>
    <div class="mb-4">
        <strong>Kelas:</strong> {{ $student->classes->class_name ?? 'Belum Mempunyai Kelas!' }}
    </div>
    <div class="flex justify-end">
        <a href="{{ route('students') }}" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Kembali</a>
    </div>
</div>
@endsection