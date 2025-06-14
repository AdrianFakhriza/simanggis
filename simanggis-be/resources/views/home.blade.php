<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Tambahkan CDN CSS AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('Logo_SiMANGGIS.png') }}" type="image/x-icon">
    <title>SIMANGGIS - Sistem Monitoring Makan Bergizi Gratis</title>
</head>

<body>
    @include('layouts.navbar')
    <audio autoplay loop muted>
        <source src="backsound.mp3" type="audio/mpeg">
        Browser Anda tidak mendukung tag audio.
    </audio>
    <section class="relative bg-gray-700 bg-blend-multiply min-h-[350px] sm:min-h-[450px] md:min-h-[550px] lg:min-h-[650px] flex items-center" data-aos="fade-down">
        <!-- Video sebagai background -->
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none z-0 flex justify-center">
            <div class="relative w-full h-full max-w-full">
                <video
                    src="{{ asset('food.mp4') }}"
                    autoplay
                    muted
                    loop
                    playsinline
                    class="w-full h-full object-cover"
                    style="pointer-events: none;"></video>
                <!-- Overlay gelap agar teks tetap terbaca -->
                <div class="absolute inset-0 bg-black opacity-20"></div>
            </div>
        </div>
        <div class="relative px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56 z-10 flex flex-col items-center justify-center w-full">
            <a data-aos="fade-down" href="#" class="inline-flex justify-between items-center py-1 px-1 pe-4 mb-7 text-sm text-blue-700 bg-blue-100 rounded-full hover:bg-blue-200">
                <span data-aos="fade-down" class="text-xs bg-blue-600 rounded-full text-white px-4 py-1.5 me-3">New</span> <span class="text-sm font-medium">Statistik Sekolah Terbaru</span>
                <svg class="w-2.5 h-2.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
            </a>
            <h1 data-aos="fade-up" class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                Sistem Monitoring <span class="underline underline-offset-3 decoration-8 decoration-blue-400">Makan Bergizi Gratis</span>
            </h1>
            <p data-aos="fade-up" class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                Monitoring Digital untuk Program Makan Gratis yang Lebih Memuaskan, Terencana dan Efisien.
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a data-aos="fade-right" href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Daftar Sekarang!
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    
            </div>
        </div>
    </section>
<section class="bg-white">
    <div class="gap-8 items-center py-8 px-</section>4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
        <img class="w-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/cta/cta-dashboard-mockup.svg" alt="dashboard image" data-aos="fade-right">
        <div class="mt-4 md:mt-0" data-aos="fade-left">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">About Us.</h2>
            <p class="mb-6 font-light text-gray-600 md:text-lg">
                Simanggis (Sistem Makan Bergizi Gratis) adalah platform digital yang dibangun untuk mendukung dan memperkuat program makan siang dan susu gratis untuk anak-anak Indonesia, sebagaimana diusung oleh Presiden Republik Indonesia.
                Kami percaya bahwa pemenuhan gizi yang baik sejak dini adalah fondasi utama bagi masa depan bangsa. Didirikan dengan semangat kepedulian sosial dan kemajuan teknologi, Simanggis hadir untuk mempermudah berbagai pihak—baik lembaga pemerintah, organisasi sosial, maupun relawan—dalam memonitor, mencatat, dan mengelola distribusi bantuan makanan bergizi dengan lebih efisien dan transparan.
            </p>
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Visi.</h2>
            <p class="mb-6 font-light text-gray-600 md:text-lg">
                Mewujudkan masyarakat yang sehat dan sejahtera melalui pendataan dan distribusi makanan bergizi gratis yang merata dan tepat sasaran.
            </p>
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Misi.</h2>
            <ul class="mb-6 font-light text-gray-600 md:text-lg list-disc list-inside space-y-2">
                <li>Membangun si</ul>stem pendataan yang akurat dan mudah digunakan untuk semua pihak yang terlibat.</li>
                <li>Mendukung program-program gizi dari pemerintah dan komunitas dengan teknologi yang responsif.</li>
                <li>Meningkatkan kesadaran akan pentingnya gizi melalui informasi yang dapat diakses oleh publik.</li>
            </ul>
            <a href="#" class="inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Get started
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<footer class="w-full bg-gray-800 text-white py-4 flex items-center justify-center">
    <span class="text-center w-full">© {{ date('Y') }} SIMANGGIS - Sistem Monitoring Makan Bergizi Gratis</span>
</footer>

<!-- Tambahkan CDN JS AOS dan inisialisasi -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>