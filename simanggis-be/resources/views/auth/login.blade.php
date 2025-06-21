<div class="flex min-h-screen">

    <a href="https://admin.simanggis.pro" target="_blank"
       rel="noopener noreferrer"
       aria-label="Kembali ke halaman utama"
       class="absolute z-10 flex items-center justify-center w-12 h-12 transition-colors bg-white rounded-full shadow-lg top-8 left-8 hover:bg-gray-100">
        <svg class="w-6 h-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5"/>
        </svg>
    </a>
    <div class="flex w-full max-w-5xl mx-auto">
        <div class="items-center justify-center hidden w-1/2 md:flex">
            <img src="{{ asset('logo-icon.png') }}" alt="Login Image" class="object-cover max-w-full max-h-full">
        </div>

        <div class="flex items-center justify-center w-full md:w-1/2">
            <x-guest-layout>
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('Logo_SiMANGGIS.png') }}" alt="Logo" class="w-auto h-16">
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="('Email')" class="hidden" />
                        <x-text-input
                            id="email"
                            name="email"
                            type="email"
                            :value="old('email')"
                            required autofocus autocomplete="username"
                            placeholder="Email"
                            class="block w-full mt-1 rounded-md bg-pink-50" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="relative mt-2">
                        <x-input-label for="password" :value="__('Password')" class="hidden" />
                            <x-text-input id="password" name="password" type="password" required autocomplete="new-password"
                                placeholder="Password" class="block w-full pr-10 mt-1 rounded-md bg-pink-50" />
                            <button type="button" onclick="togglePassword('password', 'password-toggle')"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 mt-1 text-gray-600 hover:text-gray-700">
                                <svg id="password-toggle" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif

                        <x-primary-button class="px-4 py-2 font-semibold text-white transition duration-150 bg-indigo-600 rounded-md shadow ms-3 hover:bg-indigo-700">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
                <script>
                    function togglePassword(inputId, toggleId) {
                        const input = document.getElementById(inputId);
                        const toggle = document.getElementById(toggleId);
                        const svg = toggle.querySelector('svg'); // Target the SVG inside the button

                        if (input.type === 'password') {
                            input.type = 'text';
                            // Path untuk ikon mata tercoret (visible)
                            svg.innerHTML = `
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                            `;
                        } else {
                            input.type = 'password';
                            // Path untuk ikon mata normal (hidden)
                            svg.innerHTML = `
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            `;
                        }
                    }
                </script>
            </x-guest-layout>
        </div>
    </div>
</div>
