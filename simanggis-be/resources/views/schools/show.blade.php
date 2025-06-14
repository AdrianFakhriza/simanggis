@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">{{ $school->school_name }}</h2>
        <div class="mb-4">
            <div><strong>Alamat:</strong> {{ $school->address }}</div>
            <div><strong>No. Kontak:</strong> {{ $school->contact_number }}</div>
        </div>

        <hr class="my-6">

        <h3 class="text-xl font-semibold mb-2">Daftar Siswa</h3>
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full bg-white border rounded shadow">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Nama Siswa</th>
                        <th class="px-4 py-2 border">NISN</th>
                        <th class="px-4 py-2 border">Kelas</th>
                        <th class="px-4 py-2 border">Status Makan Hari Ini</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($school->students as $student)
                    <tr>
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $student->student_name }}</td>
                        <td class="px-4 py-2 border">{{ $student->nisn }}</td>
                        <td class="px-4 py-2 border">{{ $student->class }}</td>
                        <td class="px-4 py-2 border">
                            @php
                                $todayMeal = $student->meals->where('date', date('Y-m-d'))->first();
                            @endphp
                            @if($todayMeal)
                                <span class="px-2 py-1 rounded {{ $todayMeal->status ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ $todayMeal->status ? 'Sudah Makan' : 'Belum Makan' }}
                                </span>
                            @else
                                <span class="px-2 py-1 rounded bg-gray-200 text-gray-800">Belum Diisi</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 border text-center">Belum ada siswa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <hr class="my-6">

        <h3 class="text-xl font-semibold mb-2">Feedback Makanan</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded shadow">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nama Siswa</th>
                        <th class="px-4 py-2 border">Komentar</th>
                        <th class="px-4 py-2 border">Rating</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($school->students as $student)
                        @foreach($student->feedbacks as $feedback)
                        <tr>
                            <td class="px-4 py-2 border">{{ $student->student_name }}</td>
                            <td class="px-4 py-2 border">{{ $feedback->feedback_text }}</td>
                            <td class="px-4 py-2 border">{{ $feedback->rating }}</td>
                            <td class="px-4 py-2 border">{{ $feedback->submitted_at }}</td>
                        </tr>
                        @endforeach
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 border text-center">Belum ada feedback.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection