<x-app-layout>
    @section('page-title', 'Dashboard Admin')

    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-3xl font-bold">Administrator Panel</h2>
                        <p class="text-indigo-100 mt-2 text-lg">Selamat datang, {{ Auth::user()->name }}. Sistem berjalan
                            dengan baik.</p>
                    </div>
                    <div class="hidden md:block bg-white/20 p-3 rounded-lg backdrop-blur-sm">
                        <p class="text-sm font-medium">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                    </div>
                </div>
            </div>

            @if ($pendingPendaftaran > 0)
                <div
                    class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between shadow-sm">
                    <div class="flex items-center gap-4 mb-4 md:mb-0">
                        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full animate-pulse">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-yellow-800">Verifikasi Tertunda!</h3>
                            <p class="text-yellow-700">Terdapat <span
                                    class="font-bold text-xl">{{ $pendingPendaftaran }}</span> pendaftaran mahasiswa
                                baru yang perlu diverifikasi.</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.applications.index') }}"
                        class="px-6 py-2 bg-yellow-600 text-white font-bold rounded-xl hover:bg-yellow-700 transition shadow-md whitespace-nowrap">
                        Proses Sekarang &rarr;
                    </a>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Mahasiswa</p>
                            <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalMahasiswa }}</p>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.users.index') }}"
                            class="text-xs font-bold text-blue-600 hover:underline">Kelola User &rarr;</a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Mitra</p>
                            <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalMitra }}</p>
                        </div>
                        <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.companies.index') }}"
                            class="text-xs font-bold text-green-600 hover:underline">Lihat Mitra &rarr;</a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Lowongan</p>
                            <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalLowongan }}</p>
                        </div>
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.vacancies.index') }}"
                            class="text-xs font-bold text-purple-600 hover:underline">Kelola Lowongan &rarr;</a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Dosen</p>
                            <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalDosen }}</p>
                        </div>
                        <div class="p-3 bg-pink-50 text-pink-600 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.bimbingan.index') }}"
                            class="text-xs font-bold text-pink-600 hover:underline">Cek Plotting &rarr;</a>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-800">Pendaftaran Terbaru</h3>
                        <a href="{{ route('admin.applications.index') }}"
                            class="text-sm text-indigo-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Mahasiswa</th>
                                    <th class="px-6 py-3">Posisi</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentApplications as $app)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $app->user->name }}
                                            <div class="text-xs text-gray-400">{{ $app->apply_date }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $app->vacancy->position }}
                                            <div class="text-xs text-gray-400">{{ $app->vacancy->company->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($app->status == 'pending')
                                                <span
                                                    class="px-2 py-1 text-xs font-bold rounded bg-yellow-100 text-yellow-800">Menunggu</span>
                                            @elseif($app->status == 'approved')
                                                <span
                                                    class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-800">Diterima</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-800">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.applications.show', $app->id) }}"
                                                class="text-indigo-600 hover:underline font-semibold">Review</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-400">Belum ada
                                            pendaftaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-gray-800 mb-4">Akses Cepat</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.users.create') }}"
                                class="block p-3 border border-gray-200 rounded-xl hover:bg-indigo-50 hover:border-indigo-200 transition text-sm font-medium text-gray-700 hover:text-indigo-700 flex items-center gap-3">
                                <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg"><svg class="w-4 h-4"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg></span>
                                Tambah User Baru
                            </a>
                            <a href="{{ route('admin.companies.create') }}"
                                class="block p-3 border border-gray-200 rounded-xl hover:bg-green-50 hover:border-green-200 transition text-sm font-medium text-gray-700 hover:text-green-700 flex items-center gap-3">
                                <span class="bg-green-100 text-green-600 p-2 rounded-lg"><svg class="w-4 h-4"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg></span>
                                Tambah Mitra
                            </a>
                            <a href="{{ route('admin.vacancies.create') }}"
                                class="block p-3 border border-gray-200 rounded-xl hover:bg-purple-50 hover:border-purple-200 transition text-sm font-medium text-gray-700 hover:text-purple-700 flex items-center gap-3">
                                <span class="bg-purple-100 text-purple-600 p-2 rounded-lg"><svg class="w-4 h-4"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg></span>
                                Posting Lowongan
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
