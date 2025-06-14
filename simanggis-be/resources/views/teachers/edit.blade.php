@extends('layouts.admin')

@section('title', 'Edit Guru')

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
                     <a href="{{ route('teachers') }}" class="inline-flex items-center text-blue-600 hover:underline">
                    Data Guru
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
    <div class="bg-white rounded shadow p-6 max-w-2xl mx-auto">
        <div class="flex justify-between mb-4">
            <div>
                <h2 class="text-2xl font-bold">Edit Data Guru</h2>
            </div>
            @if (session('success'))
                <div class="text-green-600 mb-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
        </div>
        @if ($errors->any())
            <div class="text-red-600 mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teachers.editForm', $teacher->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name" required
                    value="{{ old('name', $teacher->name) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" required
                    value="{{ old('username', $teacher->username) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    value="{{ old('email', $teacher->email) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password <small>(kosongkan jika tidak ingin mengubah)</small>
                </label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" autocomplete="new-password" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Konfirmasi Password
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" autocomplete="new-password" />
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('teachers') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
