<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('logo-icon-white.png') }}" type="image/x-icon">
</head>

<body class="bg-gray-100">
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-blue-400 dark:hover:bg-blue-700 text-white dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>
    <!-- Sidebar with Logo Branding -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0" aria-label="Sidebar">
        <div class="flex items-center justify-center h-16 border-b border-gray-200 bg-white">
            <span class="self-center text-2xl font-extrabold whitespace-nowrap text-blue-900 tracking-wide flex">
                <img src="{{ asset('logo-icon.png') }}" alt="Logo" class="h-10 w-auto">
                SIMANGGIS
            </span>
        </div>
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium mt-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"></path></svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('school.data') }}" class="flex items-center p-2 rounded-lg {{ request()->routeIs('school*') ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 3v18m9-9H3"></path></svg>
                        <span class="ml-3">Data Sekolah</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teachers') }}" class="flex items-center p-2 rounded-lg {{ request()->routeIs('teachers*') ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.755 6.879 2.047M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="ml-3">Data Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('class') }}" class="flex items-center p-2 rounded-lg {{ request()->routeIs('class*') ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                        <span class="ml-3">Data Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('students') }}" class="flex items-center p-2 rounded-lg {{ request()->routeIs('students*') ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75"></path></svg>
                        <span class="ml-3">Data Murid</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('meals') }}" class="flex items-center p-2 rounded-lg {{ request()->routeIs('meals*') ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                        <span class="ml-3">Data Distribusi Makanan</span>
                    </a>
                </li>
                <li class="mt-8">
                    <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Yakin ingin logout?');">
                        @csrf
                        <button type="submit" class="w-full flex items-center p-2 rounded-lg text-red-600 hover:bg-red-50">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7"></path></svg>
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
    @stack('scripts')
</body>
</html>