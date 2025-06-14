<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Dashboard Admin</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">
    <div class="min-h-screen flex">
        
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-gray-800 text-white fixed">
            <div class="p-4">
                <h2 class="text-xl font-bold">SIMANGGIS</h2>
                <ul class="mt-6 space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a></li>
                    <li><a href="{{ route('sekolah.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Data Sekolah</a></li>
                    <li><a href="{{ route('kelas.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Data Kelas</a></li>
                    <li><a href="{{ route('guru.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Data Guru</a></li>
                    <li><a href="{{ route('siswa.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Data Siswa</a></li>
                    <li><a href="{{ route('distribusi.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Data Distribusi</a></li>
                </ul>
            </div>
        </aside>

        <!-- Main content area -->
        <div class="flex-1 ml-64 min-h-screen flex flex-col">

            <!-- Navbar with Logout -->
            <nav class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
            <span class="text-xl font-semibold dark:text-white">SIMANGGIS</span>
            <a href="{{ route('logout') }}"
               class="text-red-600 hover:underline dark:text-red-400 font-medium">
               Logout
            </a>
        </div>
    </nav>

            <!-- Page Heading (optional) -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content (default via @yield) -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
