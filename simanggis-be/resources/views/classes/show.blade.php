@extends('layouts.admin')

@section('title', 'Informasi Sekolah')

@section('content')

      <!-- Page content -->
      <main class="p-6 overflow-y-auto">
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
                    <li class="inline-flex items-center">
                        <a href="{{ route('class') }}" class="text-blue-600 hover:underline">
                            Data Kelas
                        </a>
                    </li>
                    <li>
                        <span class="mx-2 text-gray-400">/</span>
                    </li>
                    <li class="inline-flex items-center text-gray-500">
                        Detail Kelas
                    </li>
                </ol>
            </nav>
        </div>

        <div class="p-6 bg-white rounded shadow">
          <h2 class="mb-4 text-2xl font-bold">Detail Kelas: {{$class->class_name}}</h2>

          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
              <p class="text-gray-600">Nama Kelas:</p>
              <p class="font-semibold text-gray-900">{{$class->class_name}}</p>
            </div>
            <div>
              <p class="text-gray-600">Sekolah:</p>
              <p class="font-semibold text-gray-900">{{$class->school->school_name}}</p>
            </div>
            <div>
              <p class="text-gray-600">Jumlah Siswa:</p>
              <p class="font-semibold text-gray-900">{{ $class->students->count() }}</p>
            </div>
            <div>
              <p class="text-gray-600">Wali Kelas:</p>
              <p class="font-semibold text-gray-900">{{$class->teacher->name}}</p>
            </div>
          </div>

          <div class="mt-6">
            <h3 class="mb-2 text-xl font-semibold">Deskripsi:</h3>
            <p class="text-gray-700">{{$class->description}}</p>
          </div>
        </div>
      </main>
 @endsection
