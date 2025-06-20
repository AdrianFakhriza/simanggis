<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('Logo_SiMANGGIS.png') }}" type="image/x-icon">
    <title>SIMANGGIS - Data Sekolah</title>
</head>

<body>
@include('layouts.navbar')
<section class="bg-white py-8 lg:py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="mx-auto max-w-screen-sm text-center">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Data Sekolah</h2>
            <p class="font-light text-gray-500 lg:mb-8 sm:text-xl dark:text-gray-400">
                Berikut adalah daftar sekolah beserta statistik jumlah guru, kelas, siswa, feedback, dan distribusi makan gratis.
            </p>
        </div>
        <div class="flex justify-center mb-8">
            <div class="w-full max-w-md">
                <div class="relative">
                    <input type="text" id="searchSekolah" placeholder="Cari nama sekolah..." class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" /></svg>
                    </div>
                </div>
            </div>
        </div>
        <div id="sekolahGrid" class="grid gap-8 mb-6 lg:mb-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($schools as $school)
            <div class="sekolah-card w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-6 flex flex-col items-center transition-transform duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-blue-50 dark:hover:bg-blue-900 cursor-pointer" data-nama="{{ strtolower($school->school_name) }}" onclick="window.location='{{ route('sekolah.show', $school->school_id) }}" data-aos="zoom-in">
                
                <div class="bg-white rounded-lg shadow p-6 mb-6 w-full">
                  
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
                    <canvas id="statistikChart{{ $school->school_id }}" height="100"></canvas>
                </div>
                <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white text-center">{{ $school->school_name }}</h3>
                <span class="text-sm text-gray-500 dark:text-gray-400 text-center mb-2">{{ $school->address ?? '-' }}</span>
                <div class="flex flex-wrap gap-2 justify-center mt-2 mb-2">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-xs">Guru: {{ $school->users->where('role','guru')->count() }}</span>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-xs">Kelas: {{ $school->classes->count() }}</span>
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-xs">Siswa: {{ $school->students->count() }}</span>
                    <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded text-xs">Feedback: {{ $school->feedback->count() }}</span>
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded text-xs">Distribusi: {{ $school->mealDistributions->count() }}</span>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const dataStatistik{{ $school->school_id }} = {
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
                        let ctx = document.getElementById('statistikChart{{ $school->school_id }}').getContext('2d');
                        let statistikChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: dataStatistik{{ $school->school_id }}.minggu.labels,
                                datasets: [
                                    {
                                        label: 'Sudah Makan',
                                        data: dataStatistik{{ $school->school_id }}.minggu.sudah,
                                        borderColor: '#1C64F2',
                                        backgroundColor: 'rgba(28,100,242,0.15)',
                                        fill: true,
                                        tension: 0.4,
                                        pointRadius: 4,
                                        pointBackgroundColor: '#1C64F2'
                                    },
                                    {
                                        label: 'Belum Makan',
                                        data: dataStatistik{{ $school->school_id }}.minggu.belum,
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
                        document.getElementById('statistikFilter{{ $school->school_id }}').addEventListener('change', function() {
                            const val = this.value;
                            statistikChart.data.labels = dataStatistik{{ $school->school_id }}[val].labels;
                            statistikChart.data.datasets[0].data = dataStatistik{{ $school->school_id }}[val].sudah;
                            statistikChart.data.datasets[1].data = dataStatistik{{ $school->school_id }}[val].belum;
                            statistikChart.update();
                        });
                    });
                </script>
                <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition" onclick="window.location='{{ route('sekolah.show', $school->school_id) }}'">Lihat Detail</button>
            </div>
            @endforeach
        </div>
    </div>
</section>



<footer class="bg-white">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="{{ url('') }}" class="flex items-center">
                  <img src="{{ asset('Logo_SiMANGGIS.png') }}" class="h-100 me-3" alt="Logo" />
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                      </li>
                      <li>
                          <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                      </li>
                      <li>
                          <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline">Privacy Policy</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
          </span>
    
      </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();

// Fitur pencarian sekolah
const input = document.getElementById('searchSekolah');
input.addEventListener('input', function() {
    const val = this.value.toLowerCase();
    document.querySelectorAll('.sekolah-card').forEach(card => {
        card.style.display = card.getAttribute('data-nama').includes(val) ? '' : 'none';
    });
});
</script>
</body>

</html>