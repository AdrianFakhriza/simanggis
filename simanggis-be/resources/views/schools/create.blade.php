@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-6">Tambah Sekolah</h2>
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('schools.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="school_name" class="block font-semibold mb-1">Nama Sekolah</label>
                <input type="text" name="school_name" id="school_name" value="{{ old('school_name') }}" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block font-semibold mb-1">Alamat</label>
                <textarea name="address" id="address" rows="3" class="w-full border px-3 py-2 rounded" required>{{ old('address') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="contact_number" class="block font-semibold mb-1">No. Kontak</label>
                <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('schools.index') }}" class="mr-3 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection