<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Update Password - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-white">

    <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 justify-center items-center">
            <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2670&auto=format&fit=crop"
                alt="Technology Background" class="absolute inset-0 w-full h-full object-cover opacity-50">
            <div class="relative z-10 px-12 text-center text-white">
                <h2 class="text-4xl font-bold mb-4 tracking-tight">Amankan Akun Anda</h2>
                <p class="text-lg text-gray-200 font-light">
                    Buat password baru yang kuat untuk melindungi data akademis dan aktivitas magang Anda.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 sm:p-12 bg-white relative">
            <div class="w-full max-w-md mx-auto">

                <div class="text-center mb-8">
                    <img class="w-20 h-20 mx-auto mb-6" src="{{ asset('image/logo_utm.png') }}" alt="Logo UTM">
                    <h2 class="text-2xl font-bold text-gray-900">Buat Password Baru</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Silakan masukkan password baru Anda di bawah ini.
                    </p>
                </div>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full bg-gray-50 text-gray-500" type="email"
                            name="email" :value="old('email', $request->email)" required autofocus readonly />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password Baru')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" placeholder="Minimal 8 karakter" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi password baru" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="pt-2">
                        <x-primary-button
                            class="w-full justify-center py-3.5 px-4 text-sm font-bold bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
