@extends('layouts.admin')

@section('title', 'Tambah Siswa')

@section('content')
    <div class="flex justify-center items-center">
        <div class="bg-white w-full max-w-xl p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Form Tambah Siswa</h2>
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('students.addData') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Siswa</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="mb-5">
                    <label for="class_id" class="block text-sm font-semibold text-gray-700 mb-1">Kelas (Label)</label>
                    <select name="class_id" id="class_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <option value="">Pilih Kelas</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <input type="hidden" name="meal_status" value="">

                <div class="flex justify-end mt-6 space-x-3">
                    <a href="{{ route('students') }}"
                        class="inline-block px-5 py-2 rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 transition duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
