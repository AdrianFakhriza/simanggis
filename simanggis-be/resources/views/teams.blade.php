
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('Logo_SiMANGGIS.png') }}" type="image/x-icon">
    <title>SIMANGGIS - Sistem Monitoring Makan Gratis</title>
</head>

<body>
    @include('layouts.navbar')
    <section class="bg-white py-8 lg:py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Team Pengembang</h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">
                    Kami adalah tim pengembang yang berfokus pada pembuatan web untuk mendukung program makan sehat gratis di sekolah-sekolah. Bersama, kami membangun solusi digital yang mudah diakses dan berdampak langsung bagi kesehatan anak-anak sekolah.
                </p>
            </div>
                    
            <div class="grid gap-8 mb-6 lg:mb-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                <!-- Najlaa -->
                <div class="w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-6 flex flex-col items-center transition-transform duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-blue-50 dark:hover:bg-blue-900" data-aos="zoom-in" data-aos-delay="100">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover" src="foto/najla.jpg" alt="Najla Avatar">
                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Najlaa Maharani Dewi Tiara Gunawan</h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Universitas Muhammadiyah Jakarta</span>
                    <p class="mt-2 mb-4 text-gray-500 dark:text-gray-400 text-center">Frontend Developer</p>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/najlamhr" class="text-gray-500 hover:text-pink-600 transition-colors duration-200">
                            <!-- Instagram SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2A5.75 5.75 0 0 0 2 7.75v8.5A5.75 5.75 0 0 0 7.75 22h8.5A5.75 5.75 0 0 0 22 16.25v-8.5A5.75 5.75 0 0 0 16.25 2h-8.5zm8.75 2.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7z"/></svg>
                        </a>
                        <a href="https://www.github.com/Najlamhr" class="text-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                            <!-- Github SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.42 2.87 8.15 6.84 9.49.5.09.66-.22.66-.48v-1.72c-2.78.6-3.37-1.35-3.37-1.35-.45-1.16-1.1-1.47-1.1-1.47-.9-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.89 1.53 2.34 1.08 2.91.83.09-.64.35-1.08.64-1.34-2.22-.25-4.56-1.11-4.56-4.95 0-1.09.39-1.99 1.03-2.69-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02A9.57 9.57 0 0112 6.84c.86.004 1.71.12 2.51.34 1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.6 1.03 2.69 0 3.85-2.34 4.7-4.57 4.94.36.31.68.92.68 1.86v2.76c0 .26.18.57.69.48A10.02 10.02 0 0022 12c0-5.52-4.48-10-10-10z"/></svg>
                        </a>
                    </div>
                </div>
                <!-- Adib -->
                <div class="w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-6 flex flex-col items-center transition-transform duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-blue-50 dark:hover:bg-blue-900" data-aos="zoom-in" data-aos-delay="200">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover" src="foto/adib.png" alt="Adib Avatar">
                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Adib Muhammad Zain</h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Universitas Nurul Jadid</span>
                    <p class="mt-2 mb-4 text-gray-500 dark:text-gray-400 text-center">Fullstack Web Developer</p>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/dibscode" class="text-gray-500 hover:text-pink-600 transition-colors duration-200">
                            <!-- Instagram SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2A5.75 5.75 0 0 0 2 7.75v8.5A5.75 5.75 0 0 0 7.75 22h8.5A5.75 5.75 0 0 0 22 16.25v-8.5A5.75 5.75 0 0 0 16.25 2h-8.5zm8.75 2.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7z"/></svg>
                        </a>
                        <a href="https://www.github.com/dibscode" class="text-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                            <!-- Github SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.42 2.87 8.15 6.84 9.49.5.09.66-.22.66-.48v-1.72c-2.78.6-3.37-1.35-3.37-1.35-.45-1.16-1.1-1.47-1.1-1.47-.9-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.89 1.53 2.34 1.08 2.91.83.09-.64.35-1.08.64-1.34-2.22-.25-4.56-1.11-4.56-4.95 0-1.09.39-1.99 1.03-2.69-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02A9.57 9.57 0 0112 6.84c.86.004 1.71.12 2.51.34 1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.6 1.03 2.69 0 3.85-2.34 4.7-4.57 4.94.36.31.68.92.68 1.86v2.76c0 .26.18.57.69.48A10.02 10.02 0 0022 12c0-5.52-4.48-10-10-10z"/></svg>
                        </a>
                    </div>
                </div>
                <!-- Adrian -->
                <div class="w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-6 flex flex-col items-center transition-transform duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-blue-50 dark:hover:bg-blue-900" data-aos="zoom-in" data-aos-delay="300">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover" src="foto/adrian.jpg" alt="Adrian Avatar">
                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Adrian Fakhriza Hakim</h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">UPN Veteran Jakarta</span>
                    <p class="mt-2 mb-4 text-gray-500 dark:text-gray-400 text-center">Backend Developer</p>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/drianriza_" class="text-gray-500 hover:text-pink-600 transition-colors duration-200">
                            <!-- Instagram SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2A5.75 5.75 0 0 0 2 7.75v8.5A5.75 5.75 0 0 0 7.75 22h8.5A5.75 5.75 0 0 0 22 16.25v-8.5A5.75 5.75 0 0 0 16.25 2h-8.5zm8.75 2.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7z"/></svg>
                        </a>
                        <a href="https://www.github.com/AdrianFakhriza" class="text-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                            <!-- Github SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.42 2.87 8.15 6.84 9.49.5.09.66-.22.66-.48v-1.72c-2.78.6-3.37-1.35-3.37-1.35-.45-1.16-1.1-1.47-1.1-1.47-.9-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.89 1.53 2.34 1.08 2.91.83.09-.64.35-1.08.64-1.34-2.22-.25-4.56-1.11-4.56-4.95 0-1.09.39-1.99 1.03-2.69-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02A9.57 9.57 0 0112 6.84c.86.004 1.71.12 2.51.34 1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.6 1.03 2.69 0 3.85-2.34 4.7-4.57 4.94.36.31.68.92.68 1.86v2.76c0 .26.18.57.69.48A10.02 10.02 0 0022 12c0-5.52-4.48-10-10-10z"/></svg>
                        </a>
                    </div>
                </div>
                <!-- Ega -->
                <div class="w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-6 flex flex-col items-center transition-transform duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-blue-50 dark:hover:bg-blue-900" data-aos="zoom-in" data-aos-delay="400">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover" src="foto/ega.jpg" alt="Ega Avatar">
                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Aditya Ega Pratama</h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">UPN Veteran Jakarta</span>
                    <p class="mt-2 mb-4 text-gray-500 dark:text-gray-400 text-center">Backend Developer</p>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/aadityaaega" class="text-gray-500 hover:text-pink-600 transition-colors duration-200">
                            <!-- Instagram SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2A5.75 5.75 0 0 0 2 7.75v8.5A5.75 5.75 0 0 0 7.75 22h8.5A5.75 5.75 0 0 0 22 16.25v-8.5A5.75 5.75 0 0 0 16.25 2h-8.5zm8.75 2.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7z"/></svg>
                        </a>
                        <a href="https://www.github.com/egaprams" class="text-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                            <!-- Github SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.42 2.87 8.15 6.84 9.49.5.09.66-.22.66-.48v-1.72c-2.78.6-3.37-1.35-3.37-1.35-.45-1.16-1.1-1.47-1.1-1.47-.9-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.89 1.53 2.34 1.08 2.91.83.09-.64.35-1.08.64-1.34-2.22-.25-4.56-1.11-4.56-4.95 0-1.09.39-1.99 1.03-2.69-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02A9.57 9.57 0 0112 6.84c.86.004 1.71.12 2.51.34 1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.6 1.03 2.69 0 3.85-2.34 4.7-4.57 4.94.36.31.68.92.68 1.86v2.76c0 .26.18.57.69.48A10.02 10.02 0 0022 12c0-5.52-4.48-10-10-10z"/></svg>
                        </a>
                    </div>
                </div>
                <!-- Efendi -->
                <div class="w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-6 flex flex-col items-center transition-transform duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-blue-50 dark:hover:bg-blue-900" data-aos="zoom-in" data-aos-delay="500">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover" src="foto/pendi.jpg" alt="Pendi Avatar">
                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Muhammad Efendi</h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Universitas Muhammadiyah Jakarta</span>
                    <p class="mt-2 mb-4 text-gray-500 dark:text-gray-400 text-center">Frontend Developer</p>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/muhamad.ev/" class="text-gray-500 hover:text-pink-600 transition-colors duration-200">
                            <!-- Instagram SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2A5.75 5.75 0 0 0 2 7.75v8.5A5.75 5.75 0 0 0 7.75 22h8.5A5.75 5.75 0 0 0 22 16.25v-8.5A5.75 5.75 0 0 0 16.25 2h-8.5zm8.75 2.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7z"/></svg>
                        </a>
                        <a href="https://github.com/muhamadpendi10" class="text-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                            <!-- Github SVG -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.42 2.87 8.15 6.84 9.49.5.09.66-.22.66-.48v-1.72c-2.78.6-3.37-1.35-3.37-1.35-.45-1.16-1.1-1.47-1.1-1.47-.9-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.89 1.53 2.34 1.08 2.91.83.09-.64.35-1.08.64-1.34-2.22-.25-4.56-1.11-4.56-4.95 0-1.09.39-1.99 1.03-2.69-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02A9.57 9.57 0 0112 6.84c.86.004 1.71.12 2.51.34 1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.6 1.03 2.69 0 3.85-2.34 4.7-4.57 4.94.36.31.68.92.68 1.86v2.76c0 .26.18.57.69.48A10.02 10.02 0 0022 12c0-5.52-4.48-10-10-10z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>