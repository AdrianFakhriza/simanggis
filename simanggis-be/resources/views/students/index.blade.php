@extends('layouts.admin')

@section('title', 'Manajemen Siswa')

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
                    Data Siswa
                </li>
            </ol>
        </nav>
    </div>
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Daftar Siswa</h2>
        @if (session('success'))
            <div class="p-2 text-green-600 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('students.addForm') }}" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            + Tambah Siswa
        </a>
    </div>

    <div class="p-4 overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-left table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Kelas</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td class="w-12 px-2 py-2 text-center border">{{ $loop->iteration }}</td>
                        <td class="w-56 px-4 py-2 border">{{ $student->name }}</td>
                        <td class="w-64 px-4 py-2 border">{{ $student->classes->class_name ?? 'Belum Mempunyai Kelas!' }}</td>
                        <td class="w-32 px-2 py-2 border">
                            <div class="flex justify-center gap-2">
                                <div class="flex flex-col items-center">
                                    <a href="{{ route('students.show', $student->student_id) }}" class="flex flex-col items-center text-green-600 hover:underline">
                                        <!-- Detail Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                                <div class="flex flex-col items-center">
                                    <a href="{{ route('students.editForm', $student->student_id) }}" class="flex flex-col items-center text-blue-600 hover:underline">
                                        <!-- Edit Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-2.828 0L9 13zm0 0v2a2 2 0 002 2h2" />
                                        </svg>
                                        Edit
                                    </a>
                                </div>
                                <div class="flex flex-col items-center">
                                    <form action="{{ route('students.deleteData', $student->student_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');" class="flex flex-col items-center">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Delete Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mb-1 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
