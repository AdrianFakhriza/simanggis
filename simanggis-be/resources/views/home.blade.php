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
                
                    <div class="absolute inset-0 bg-blue-900">@include('components.bubble-food')</div>
                <!-- Overlay gelap agar teks tetap terbaca -->
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
                <a data-aos="fade-right" href="{{ url('/sekolah') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Daftar Sekolah
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
    <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Tentang Kami</h2>
        <p class="mb-6 font-light text-gray-600 md:text-lg">
            Simanggis (Sistem Makan Bergizi Gratis) adalah platform digital yang dibangun untuk mendukung dan memperkuat program makan siang dan susu gratis untuk anak-anak Indonesia, sebagaimana diusung oleh Presiden Republik Indonesia.
            Kami percaya bahwa pemenuhan gizi yang baik sejak dini adalah fondasi utama bagi masa depan bangsa. Didirikan dengan semangat kepedulian sosial dan kemajuan teknologi, Simanggis hadir untuk mempermudah berbagai pihak—baik lembaga pemerintah, organisasi sosial, maupun relawan—dalam memonitor, mencatat, dan mengelola distribusi bantuan makanan bergizi dengan lebih efisien dan transparan.
        </p>
    </div>
    <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
        <div class="mt-4 md:mt-0" data-aos="fade-right">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Mengapa Simanggis?</h2>
            <p class="mb-6 font-light text-gray-600 md:text-lg">
                Simanggis dirancang untuk menjawab tantangan dalam distribusi makanan bergizi bagi anak-anak Indonesia. Dengan teknologi yang mudah diakses, kami membantu memastikan bahwa setiap anak mendapatkan gizi yang mereka butuhkan untuk tumbuh dan berkembang dengan baik.
            </p>
            <ul class="mb-6 font-light text-gray-600 md:text-lg list-disc list-inside space-y-2">
                <li>Mempermudah pendataan dan distribusi makanan bergizi.</li>
                <li>Meningkatkan transparansi dan akuntabilitas dalam program bantuan makanan.</li>
                <li>Mendukung kolaborasi antara pemerintah, organisasi sosial, dan masyarakat.</li>
            </ul>
        </div>
        <img class="w-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/cta/cta-dashboard-mockup.svg" alt="dashboard image" data-aos="fade-left">
    </div>
    <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
        <img class="w-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/cta/cta-dashboard-mockup.svg" alt="dashboard image" data-aos="fade-right">
        <div class="mt-4 md:mt-0" data-aos="fade-left">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Visi.</h2>
            <p class="mb-6 font-light text-gray-600 md:text-lg">
                Mewujudkan masyarakat yang sehat dan sejahtera melalui pendataan dan distribusi makanan bergizi gratis yang merata dan tepat sasaran.
            </p>
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Misi.</h2>
            <ul class="mb-6 font-light text-gray-600 md:text-lg list-disc list-inside space-y-2">
                <li>Membangun sistem pendataan yang akurat dan mudah digunakan untuk semua pihak yang terlibat.</li>
                <li>Mendukung program-program gizi dari pemerintah dan komunitas dengan teknologi yang responsif.</li>
                <li>Meningkatkan kesadaran akan pentingnya gizi melalui informasi yang dapat diakses oleh publik.</li>
            </ul>
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
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
          </span>
    
      </div>
    </div>
</footer>


<!-- Tambahkan CDN JS AOS dan inisialisasi -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>