<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-8 bg-white border border-black rounded-lg">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Logo Simanggis -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('Logo_SiMANGGIS.png') }}" alt="Logo" class="w-auto h-16">
                </div>

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="hidden" />
                    <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus
                        autocomplete="name" placeholder="Name" class="block w-full mt-1 rounded-md bg-pink-50" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Username -->
                <div class="mt-2">
                    <x-input-label for="username" :value="__('Username')" class="hidden" />
                    <x-text-input id="username" name="username" type="text" :value="old('username')" required
                        autocomplete="username" placeholder="Username"
                        class="block w-full mt-1 rounded-md bg-pink-50" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-2">
                    <x-input-label for="email" :value="('Email')" class="hidden" />
                    <x-text-input id="email" name="email" type="email" :value="old('email')" required
                        autocomplete="email" placeholder="Email" class="block w-full mt-1 rounded-md bg-pink-50" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- School Name -->
                <div class="mt-2">
                    <x-input-label for="school_name" :value="__('School Name')" class="hidden" />
                    <x-text-input id="school_name" name="school_name" type="text" :value="old('school_name')" required
                        autocomplete="off" placeholder="School Name" class="block w-full mt-1 rounded-md bg-pink-50" />
                    <x-input-error :messages="$errors->get('school_name')" class="mt-2" />
                </div>

                <!-- Password -->
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

                <!-- Confirm Password -->
                <div class="relative mt-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="hidden" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                        autocomplete="new-password" placeholder="Confirm Password"
                        class="block w-full pr-10 mt-1 rounded-md bg-pink-50" />
                    <button type="button" onclick="togglePassword('password_confirmation', 'confirm-password-toggle')"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 mt-1 text-gray-600 hover:text-gray-700">
                        <svg id="confirm-password-toggle" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button
                        class="px-4 py-2 font-semibold text-white transition duration-150 bg-indigo-600 rounded-md shadow ms-3 hover:bg-indigo-700">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);

            if (input.type === 'password') {
                input.type = 'text';
                toggle.innerHTML = `
                    <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                    <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                `;
            } else {
                input.type = 'password';
                toggle.innerHTML = `
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                `;
            }
        }
    </script>
</x-guest-layout>
