@extends('layouts.admin')

@section('title', 'Tambah Kelas')

@section('content')
    <div class="mb-6">
        <a href="{{ route('class') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Daftar Kelas</a>
    </div>

    <div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
        <h2 class="text-2xl font-bold mb-4">Form Tambah Kelas</h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('class.addData') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700">Nama Kelas</label>
                <input type="text"
                       name="class_name"
                       placeholder="Contoh: X IPA 1"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required
                />
            </div>

            <div>
                <label class="block text-gray-700">Wali Kelas</label>
                <select name="teacher_id"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">-- Pilih Wali Kelas --</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Deskripsi (opsional)</label>
                <textarea name="description"
                          rows="4"
                          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Deskripsi kelas…"></textarea>
            </div>

            <div class="pt-4 flex justify-end space-x-2">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('class') }}"
                   class="px-4 py-2 text-gray-700 border rounded hover:bg-gray-100">
                   Batal
                </a>
            </div>
        </form>
    </div>
@endsection
