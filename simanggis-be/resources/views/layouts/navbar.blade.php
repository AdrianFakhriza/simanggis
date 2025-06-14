<nav class="bg-white border-gray-200">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">
            <a href="{{ url('') }}" class="flex items-center space-x-3 rtl:space-x-reverse" data-aos="fade-right">
                <img src="{{ asset('Logo_SiMANGGIS.png') }}" class="h-100" alt="Flowbite Logo" />
            </a>
            <div class="flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                <a href="{{ route('login') }}" class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 focus:outline-none" data-aos="fade-left">Login</a>
                <a href="{{ route('register') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 focus:outline-none" data-aos="fade-left">Daftar</a>
                <button data-collapse-toggle="mega-menu-icons" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mega-menu-icons" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div id="mega-menu-icons" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
                    <li>
                        <a href="{{ url('') }}"
                           class="block py-2 px-3 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent {{ request()->is('/') ? 'text-blue-600 md:hover:text-blue-600' : 'text-gray-900 md:hover:text-blue-600' }}"
                           aria-current="{{ request()->is('/') ? 'page' : '' }}"
                           data-aos="fade-down">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/teams') }}"
                           class="block py-2 px-3 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent {{ request()->is('teams') ? 'text-blue-600 md:hover:text-blue-600' : 'text-gray-900 md:hover:text-blue-600' }}"
                           aria-current="{{ request()->is('teams') ? 'page' : '' }}"
                           data-aos="fade-down">
                            Team
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>