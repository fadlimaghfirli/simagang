<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMAGANG - Sistem Informasi Magang Terpadu</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans text-gray-800 bg-white">

    <nav x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'bg-white/80 backdrop-blur-md shadow-sm' : 'bg-transparent'"
        class="fixed w-full z-50 transition-all duration-300 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <img class="w-8 h-8" src="image/logo_utm.png" alt="">
                    {{-- <div class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white p-2 rounded-lg shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div> --}}
                    <span
                        class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-700 to-purple-700">
                        SIMAGANG
                    </span>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        @php
                            $dashboardRoute = match (Auth::user()->role) {
                                'admin' => 'admin.dashboard',
                                'dosen' => 'dosen.dashboard',
                                default => 'mahasiswa.dashboard',
                            };
                        @endphp
                        <a href="{{ route($dashboardRoute) }}"
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Dashboard Saya
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span class="max-sm:hidden ">Masuk Akun</span>
                            <span class="md:hidden sm:block ">Masuk</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
            <div
                class="absolute top-20 left-20 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 max-sm:opacity-50 animate-blob">
            </div>
            <div
                class="absolute top-60 max-sm:top-96 right-20 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 max-sm:opacity-50 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-32 left-1/2 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 max-sm:opacity-50 animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div
                    class="inline-block mb-4 px-4 py-1.5 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-sm">
                    🚀 Platform Magang Industri Prodi <a href="https://pif.trunojoyo.ac.id/" target="blank"
                        class="font-bold hover:underline">Pendidikan
                        Informatika</a>
                    Universitas Trunojoyo Madura
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6">
                    Jembatan Menuju <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Karir
                        Profesionalmu</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Sistem terintegrasi untuk pengelolaan magang mahasiswa. Mulai dari pencarian lowongan, logbook
                    harian, hingga penilaian dosen dalam satu platform.
                </p>

                <div class="flex flex-col items-center mb-10">
                    <p
                        class="text-sm text-gray-500 bg-white/80 backdrop-blur px-4 py-2 rounded-full border border-gray-200 shadow-sm">
                        ℹ️ Mahasiswa & Dosen silakan login menggunakan akun yang diberikan Akademik.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('mahasiswa.lowongan.index') }}"
                            class="px-8 py-4 text-lg font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition shadow-lg hover:shadow-indigo-500/30 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari Lowongan
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-8 py-4 text-lg font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition shadow-lg hover:shadow-indigo-500/30">
                            Login ke Portal
                        </a>
                        <a href="#fitur"
                            class="px-8 py-4 text-lg font-bold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition shadow-sm">
                            Pelajari Fitur
                        </a>
                    @endauth
                </div>
            </div>

            <div class="mt-16 relative">
                {{-- <div
                    class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent z-20 h-full bottom-0">
                </div> --}}
                <div
                    class="rounded-2xl bg-gray-700 p-2 shadow-2xl max-md:w-80 max-w-4xl mx-auto transform rotate-2 hover:-rotate-2 transition duration-500">
                    <div class="rounded-xl overflow-hidden bg-white border border-gray-800">
                        <div class="bg-gray-100 border-b border-gray-200 px-4 py-3 flex items-center gap-2">
                            <div class="max-sm:hidden w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="max-sm:hidden w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="max-sm:hidden mr-4 w-3 h-3 rounded-full bg-green-500"></div>
                            <div
                                class="bg-white rounded-md px-3 py-1 text-xs text-gray-400 flex-1 text-center font-mono">
                                simagang.informatik.my.id</div>
                        </div>
                        <div class="bg-gray-50 p-4 md:p-8 grid gap-6">
                            <div class="flex justify-between items-center">
                                <div class="h-8 w-48 bg-indigo-200 rounded-lg animate-pulse"></div>
                                <div class="h-10 w-10 bg-purple-200 rounded-full animate-pulse"></div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div
                                    class="h-32 bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-col justify-between">
                                    <div class="w-10 h-10 bg-indigo-50 rounded-lg"></div>
                                    <div class="h-4 w-24 bg-gray-100 rounded"></div>
                                </div>
                                <div
                                    class="max-md:hidden h-32 bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-col justify-between">
                                    <div class="w-10 h-10 bg-green-50 rounded-lg"></div>
                                    <div class="h-4 w-24 bg-gray-100 rounded"></div>
                                </div>
                                <div
                                    class="max-md:hidden h-32 bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-col justify-between">
                                    <div class="w-10 h-10 bg-purple-50 rounded-lg"></div>
                                    <div class="h-4 w-24 bg-gray-100 rounded"></div>
                                </div>
                            </div>
                            <div class="h-64 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <div class="h-6 w-32 bg-gray-100 rounded mb-4"></div>
                                <div class="space-y-3">
                                    <div class="h-4 w-full bg-gray-50 rounded"></div>
                                    <div class="h-4 w-5/6 bg-gray-50 rounded"></div>
                                    <div class="h-4 w-4/6 bg-gray-50 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 bg-indigo-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-indigo-800">
                <div>
                    <p class="text-4xl font-bold text-indigo-300">{{ $totalMahasiswa }}</p>
                    <p class="text-sm text-indigo-100 mt-1 uppercase tracking-wide">Mahasiswa Aktif</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-pink-300">{{ $totalMitra }}</p>
                    <p class="text-sm text-indigo-100 mt-1 uppercase tracking-wide">Mitra Perusahaan</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-yellow-300">{{ $totalLowongan }}</p>
                    <p class="text-sm text-indigo-100 mt-1 uppercase tracking-wide">Lowongan Tersedia</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-green-300">100%</p>
                    <p class="text-sm text-indigo-100 mt-1 uppercase tracking-wide">Digitalisasi</p>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Fitur Unggulan</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Kelola Magang dengan Lebih Efisien
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10">
                <div
                    class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pencarian Lowongan</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Lihat daftar perusahaan mitra yang membuka lowongan dan lamar posisi yang sesuai dengan keahlian
                        Anda.
                    </p>
                </div>

                <div
                    class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                    <div
                        class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600 mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Logbook Digital</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Isi kegiatan harian Anda secara online dan dapatkan validasi langsung dari Dosen Pembimbing.
                    </p>
                </div>

                <div
                    class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                    <div
                        class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-green-600 mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Penilaian Terpadu</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Unggah laporan akhir dan pantau nilai magang Anda secara transparan melalui dashboard sistem.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-indigo-800 to-purple-900 py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-bold text-white mb-4">Belum Memiliki Akun?</h2>
            <p class="text-indigo-200 text-lg mb-8">
                Silakan hubungi Admin Prodi atau Bagian Akademik untuk mendapatkan akses login ke dalam sistem.
            </p>
            <div class="flex justify-center">
                <a href="{{ route('login') }}"
                    class="px-8 py-4 bg-white text-indigo-700 font-bold rounded-xl shadow-lg hover:bg-gray-100 transition transform hover:-translate-y-1 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Login ke Sistem
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <span class="text-white font-bold text-lg">SIMAGANG</span>
                <p class="text-sm mt-1">&copy; {{ date('Y') }} Pendidikan Informatika - Universitas Trunojoyo
                    Madura. All rights reserved.
                </p>
            </div>
            <div class="flex gap-6 text-sm">
                <a href="#" class="hover:text-white transition">Panduan</a>
                <a href="#" class="hover:text-white transition">Kontak Admin</a>
            </div>
        </div>
    </footer>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>

</html>
