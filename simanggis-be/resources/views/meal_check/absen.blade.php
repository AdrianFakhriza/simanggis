@extends('layouts.teacher')

@section('content')
<div class="container px-4 mx-auto mt-8">
    <div class="overflow-hidden bg-white shadow-lg rounded-xl">
        <div class="px-6 py-4 text-white bg-blue-600">
            <h2 class="text-xl font-semibold">Absensi Penerimaan Makanan</h2>
        </div>

        <div class="p-6">
            <div class="mb-4 space-x-4">
                <span class="inline-block px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">
                    Kelas: <b>{{ $class_id }}</b>
                </span>
                <span class="inline-block px-3 py-1 text-sm font-medium text-gray-800 bg-gray-200 rounded-full">
                    Tanggal: <b>{{ $meal_date }}</b>
                </span>
            </div>

            <form method="POST" action="{{ route('meal_check.absen.store') }}">
                @csrf
                <input type="hidden" name="class_id" value="{{ $class_id }}">
                <input type="hidden" name="meal_date" value="{{ $meal_date }}">

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="text-gray-700 bg-gray-100">
                            <tr>
                                <th class="w-16 px-4 py-3 text-left border-b">No</th>
                                <th class="px-4 py-3 text-left border-b">Nama Siswa</th>
                                <th class="px-4 py-3 text-center border-b">Sudah Terima?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $i => $student)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border-b">{{ $i + 1 }}</td>
                                <td class="px-4 py-2 border-b">{{ $student->name }}</td>
                                <td class="px-4 py-2 text-center border-b">
                                    <input type="checkbox" class="w-5 h-5 text-green-500 form-checkbox" name="received[]" value="{{ $student->student_id }}"
                                    {{ (isset($mealDistributions[$student->student_id]) && $mealDistributions[$student->student_id]->status == 'received') ? 'checked' : '' }}>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 text-right">
                    <button type="submit" class="px-6 py-2 text-white transition bg-green-600 rounded-lg hover:bg-green-700">
                        <i class="mr-1 bi bi-save"></i> Simpan Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
