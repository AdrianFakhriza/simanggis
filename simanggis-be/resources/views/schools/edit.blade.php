@extends('layouts.admin')

@section('title', 'Edit Informasi Sekolah')

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
                <li class="inline-flex items-center">
                    <a href="{{ route('school.data') }}" class="text-blue-600 hover:underline">
                        Data Sekolah
                    </a>
                </li>
                <li>
                    <span class="mx-2 text-gray-400">/</span>
                </li>
                <li class="inline-flex items-center text-gray-500">
                    Edit Sekolah
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-white rounded shadow p-6 max-w-xl mx-auto">
        <h2 class="text-2xl font-bold mb-4">Form Edit Profil Sekolah</h2>

        @if ($errors->any())
            <div class="text-red-600 mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('school.update', $school->school_id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="school_name" class="block text-gray-700">Nama Sekolah</label>
                <input
                    type="text"
                    id="school_name"
                    name="school_name"
                    class="w-full mt-1 px-3 py-2 border rounded"
                    value="{{ old('school_name', $school->school_name) }}"
                    required
                >
            </div>

            <div>
                <label for="address" class="block text-gray-700">Alamat</label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    class="w-full mt-1 px-3 py-2 border rounded"
                    value="{{ old('address', $school->address) }}"
                    required
                >
            </div>

            <div>
                <label for="contact_number" class="block text-gray-700">Nomor Kontak</label>
                <input
                    type="text"
                    id="contact_number"
                    name="contact_number"
                    class="w-full mt-1 px-3 py-2 border rounded"
                    value="{{ old('contact_number', $school->contact_number) }}"
                    required
                >
            </div>

            <div class="pt-4 flex justify-end space-x-2">
                <a href="{{ route('school.data') }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
