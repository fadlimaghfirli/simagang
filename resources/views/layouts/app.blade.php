<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gray-100">

        <div class="fixed top-0 w-full z-50">
            @include('layouts.partials.navbar')
        </div>

        <div class="flex pt-16 h-screen overflow-hidden">
            <div x-show="sidebarOpen" @click="sidebarOpen = false"
                x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 md:hidden mt-16"> </div>

            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-white border-r transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:h-full md:top-0 flex flex-col">

                @if (Auth::user()->role == 'admin')
                    @include('layouts.partials.sidebar-admin')
                @elseif(Auth::user()->role == 'dosen')
                    @include('layouts.partials.sidebar-dosen')
                @elseif(Auth::user()->role == 'mahasiswa')
                    @include('layouts.partials.sidebar-mahasiswa')
                @endif
            </aside>

            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-100 w-full">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>

</html>
