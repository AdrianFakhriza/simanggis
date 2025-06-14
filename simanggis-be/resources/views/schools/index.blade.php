@extends('layouts.admin')

@section('title', 'Informasi Sekolah')

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
                    Data Sekolah
                </li>
            </ol>
        </nav>
    </div>

    <div class="p-4 overflow-x-auto bg-white rounded shadow">
        <h2 class="mb-4 text-2xl font-bold">Profil Sekolah</h2>
        <table class="min-w-full text-left table-auto">
            <tbody>
                <tr>
                    <th class="w-1/4 px-4 py-2 bg-gray-100 border">Nama Sekolah</th>
                    <td class="px-4 py-2 border">{{ $school->school_name }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border">Alamat</th>
                    <td class="px-4 py-2 border">{{ $school->address }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border">Nomor Kontak</th>
                    <td class="px-4 py-2 border">{{ $school->contact_number }}</td>
                </tr>
            </tbody>
        </table>
    </div>

        <div class="mt-6">
            <a href="{{ route('school.detail') }}"
               class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Edit Informasi
            </a>
        </div>
    </div>
@endsection
