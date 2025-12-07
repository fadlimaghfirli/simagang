<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-white">

    <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 justify-center items-center">
            <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?q=80&w=2670&auto=format&fit=crop"
                alt="Security Background" class="absolute inset-0 w-full h-full object-cover opacity-50">

            <div class="relative z-10 px-12 text-center text-white">
                <h2 class="text-4xl font-bold mb-4 tracking-tight">Pemulihan akun</h2>
                <p class="text-lg text-gray-200 font-light leading-relaxed max-w-lg mx-auto">
                    Jangan khawatir. Keamanan data Anda adalah prioritas kami. Ikuti langkah mudah untuk mendapatkan
                    akses kembali.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 sm:p-12 bg-white relative">

            <div class="w-full max-w-md mx-auto mb-8">
                <a href="{{ route('login') }}"
                    class="group inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Login
                </a>
            </div>

            <div class="w-full max-w-md mx-auto">

                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Lupa Password?</h2>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                        Masukkan alamat email yang terdaftar, dan kami akan mengirimkan tautan untuk mereset password
                        Anda.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-1">
                        <x-input-label for="email" :value="__('Alamat Email')" class="text-gray-700 font-semibold" />
                        <x-text-input id="email"
                            class="block mt-1 w-full rounded-lg border-gray-300 py-3 px-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50"
                            type="email" name="email" :value="old('email')" required autofocus
                            placeholder="123xxx@trunojoyo.ac.id" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button
                            class="w-full justify-center py-3.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
