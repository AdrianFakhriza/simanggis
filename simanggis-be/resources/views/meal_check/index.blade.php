@extends('layouts.teacher')

@section('title', 'Absensi Makanan')

@section('content')
    <h1 class="mb-4 text-2xl font-bold">Rekap Absensi Makanan</h1>

    @if(session('success'))
        <div class="p-3 mb-4 text-green-800 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-4 overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-left table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-2">Tanggal</th>
                    <th class="px-6 py-2">Kelas</th>
                    <th class="px-6 py-2">Sudah Terima</th>
                    <th class="px-6 py-2">Belum Terima</th>
                    <th class="px-6 py-2">Aksi</th>
                </tr>
            </thead>
            </thead>
            <tbody>
                @forelse($rekap as $data)
                    <tr class="transition hover:bg-gray-50">
                        <td class="px-6 py-4 border-b">{{ \Carbon\Carbon::parse($data->meal_date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 border-b">{{ $data->class->class_name ?? 'Tidak diketahui' }}</td>
                        <td class="px-6 py-4 font-medium text-green-600 border-b">{{ $data->received }}</td>
                        <td class="px-6 py-4 font-medium text-red-600 border-b">{{ $data->not_received }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('meal_check.absen', ['class_id' => $data->class->class_id, 'meal_date' => $data->meal_date]) }}"
                               class="inline-block px-4 py-2 text-sm text-white transition bg-blue-600 rounded hover:bg-blue-700">
                                Isi Absensi
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">Tidak ada data absensi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
