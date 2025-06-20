<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard Guru')</title>
    <!-- Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('logo-icon-white.png') }}" type="image/x-icon">
</head>

<body class="bg-gray-100">
    <!-- Sidebar Guru -->
    <aside id="teacher-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0" aria-label="Sidebar">
        <div class="flex items-center justify-center h-16 border-b border-gray-200 bg-white">
            <span class="self-center text-2xl font-extrabold whitespace-nowrap text-blue-900 tracking-wide flex">
                <img src="{{ asset('logo-icon.png') }}" alt="Logo" class="h-10 w-auto">
                SIMANGGIS
            </span>
        </div>
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium mt-4">
                <li>
                    <a href="" class="flex items-center p-2 rounded-lg {{ request()->routeIs('teacher.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"></path>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('meal.check.index') }}" class="flex items-center p-2 rounded-lg {{ request()->routeIs('meal.check.*') ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-3">Absensi Makanan</span>
                    </a>
                </li>
                <li class="mt-8">
                    <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Yakin ingin logout?');">
                        @csrf
                        <button type="submit" class="w-full flex items-center p-2 rounded-lg text-red-600 hover:bg-red-50">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="p-4 md:ml-64 pt-8">
        @yield('content')
    </div>
</body>

</html>
