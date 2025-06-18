<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('Logo_SiMANGGIS.png') }}" type="image/x-icon">
    <title>SIMANGGIS - Detail Sekolah</title>
</head>

<body>
@include('layouts.navbar')
<section class="bg-white py-8 lg:py-16">
    <div class="max-w-screen-md mx-auto px-4">
        <div class="mb-8 text-center">
            <h2 class="mb-2 text-3xl tracking-tight font-extrabold text-gray-900">{{ $school->school_name }}</h2>
            <p class="text-gray-500 dark:text-gray-400">{{ $school->address ?? '-' }}</p>
        </div>
        <div class="bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-6 flex flex-col items-center mb-8">
            <div class="w-full">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <span class="text-2xl font-bold text-blue-700">{{ $school->siswaSudahMakan ?? 0 }}</span>
                        <span class="ml-2 text-sm text-gray-500">Sudah</span>
                    </div>
                    <div>
                        <span class="text-2xl font-bold text-red-600">{{ $school->siswaBelumMakan ?? 0 }}</span>
                        <span class="ml-2 text-sm text-gray-500">Belum</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 justify-center mt-2 mb-2">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-xs">Guru: {{ $school->users->where('role','guru')->count() }}</span>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-xs">Kelas: {{ $school->classes->count() }}</span>
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-xs">Siswa: {{ $school->students->count() }}</span>
                    <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded text-xs">Feedback: {{ $school->feedback->count() }}</span>
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded text-xs">Distribusi: {{ $school->mealDistributions->count() }}</span>
                </div>
                <div class="mb-2">
                    <label for="statistikFilter" class="block text-sm font-medium text-gray-700 mb-1">Lihat Grafik:</label>
                    <select id="statistikFilter" class="border rounded px-2 py-1">
                        <option value="minggu">Mingguan</option>
                        <option value="bulan">Bulanan</option>
                        <option value="tahun">Tahunan</option>
                    </select>
                </div>
                <canvas id="statistikChart" height="100"></canvas>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded shadow p-6">
                <h2 class="text-lg font-semibold mb-2">Data Guru</h2>
                <ul class="list-disc ml-5">
                    @foreach($school->users->where('role','guru') as $guru)
                    <li>{{ $guru->name }} ({{ $guru->email }})</li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white rounded shadow p-6">
                <h2 class="text-lg font-semibold mb-2">Data Kelas</h2>
                <ul class="list-disc ml-5">
                    @foreach($school->classes as $kelas)
                    <li>{{ $kelas->class_name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded shadow p-6">
                <h2 class="text-lg font-semibold mb-2">Data Siswa</h2>
                <ul class="list-disc ml-5">
                    @foreach($school->students as $siswa)
                    <li>{{ $siswa->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white rounded shadow p-6">
                <h2 class="text-lg font-semibold mb-2">Feedback</h2>
                <ul class="list-disc ml-5">
                    @foreach($school->feedback as $fb)
                    <li>{{ $fb->content }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
<footer class="bg-white">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dataStatistik = {
            minggu: {
                labels: {!! json_encode($school->labelsMinggu ?? ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']) !!},
                sudah: {!! json_encode($school->dataMingguSudah ?? [0,0,0,0,0,0,0]) !!},
                belum: {!! json_encode($school->dataMingguBelum ?? [0,0,0,0,0,0,0]) !!}
            },
            bulan: {
                labels: {!! json_encode($school->labelsBulan ?? ['01 Jun', '02 Jun', '03 Jun', '04 Jun', '05 Jun', '06 Jun', '07 Jun']) !!},
                sudah: {!! json_encode($school->dataBulanSudah ?? [0,0,0,0,0,0,0]) !!},
                belum: {!! json_encode($school->dataBulanBelum ?? [0,0,0,0,0,0,0]) !!}
            },
            tahun: {
                labels: {!! json_encode($school->labelsTahun ?? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']) !!},
                sudah: {!! json_encode($school->dataTahunSudah ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!},
                belum: {!! json_encode($school->dataTahunBelum ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!}
            }
        };
        let ctx = document.getElementById('statistikChart').getContext('2d');
        let statistikChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dataStatistik.minggu.labels,
                datasets: [
                    {
                        label: 'Sudah Makan',
                        data: dataStatistik.minggu.sudah,
                        borderColor: '#1C64F2',
                        backgroundColor: 'rgba(28,100,242,0.15)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#1C64F2'
                    },
                    {
                        label: 'Belum Makan',
                        data: dataStatistik.minggu.belum,
                        borderColor: '#EF4444',
                        backgroundColor: 'rgba(239,68,68,0.12)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#EF4444'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#374151',
                            font: { size: 14 }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: '#6B7280',
                            font: { size: 12 },
                            autoSkip: true,
                            maxTicksLimit: 7
                        }
                    },
                    y: {
                        grid: { display: false },
                        beginAtZero: true,
                        ticks: { color: '#6B7280', font: { size: 12 } }
                    }
                }
            }
        });
        document.getElementById('statistikFilter').addEventListener('change', function() {
            const val = this.value;
            statistikChart.data.labels = dataStatistik[val].labels;
            statistikChart.data.datasets[0].data = dataStatistik[val].sudah;
            statistikChart.data.datasets[1].data = dataStatistik[val].belum;
            statistikChart.update();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>
</body>
</html>
