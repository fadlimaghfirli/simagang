<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-white">

    <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 justify-center items-center">
            <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2564&auto=format&fit=crop"
                alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-60">

            <div class="relative z-10 px-12 text-center text-white">
                <h1 class="text-5xl font-bold mb-6 tracking-tight">Sistem Informasi Magang</h1>
                <p class="text-lg text-gray-200 font-light leading-relaxed">
                    Masuk ke sistem untuk mengelola <br> produktivitas Anda dengan lebih efisien dan terintegrasi.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 sm:p-12 bg-white relative">

            <div class="w-full max-w-md mx-auto mb-8">
                <a href="{{ url('/') }}"
                    class="group inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="w-full max-w-md mx-auto space-y-8">

                <div class="text-center">
                    {{-- <x-application-logo class="w-12 h-12 mx-auto fill-current text-indigo-600 mb-4" /> --}}
                    <img class="w-20 h-20 mx-auto mb-6" src="image/logo_utm.png" alt="Logo UTM">
                    <h2 class="text-3xl font-extrabold text-gray-900">Login</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Silakan masukkan identitas Anda.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                    @csrf

                    <div class="space-y-1">
                        <x-input-label for="email" :value="__('Alamat Email')" class="text-gray-700 font-semibold" />
                        <x-text-input id="email"
                            class="block mt-1 w-full rounded-lg border-gray-300 py-3 px-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50"
                            type="email" name="email" :value="old('email')" required autofocus
                            placeholder="123xxx@trunojoyo.ac.id" autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" :value="__('Kata Sandi')" class="text-gray-700 font-semibold" />
                        </div>
                        <x-text-input id="password"
                            class="block mt-1 w-full rounded-lg border-gray-300 py-3 px-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50"
                            type="password" name="password" required placeholder="Masukkan kata sandi Anda"
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-4 w-4"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>

                    <div>
                        <x-primary-button
                            class="w-full justify-center py-3.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            {{ __('Masuk') }}
                        </x-primary-button>
                    </div>
                </form>

                <p class="mt-4 text-center text-xs text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. Restricted Area.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
