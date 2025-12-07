<x-app-layout>
    @section('page-title', 'Dashboard')

    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-3xl font-bold">Halo, {{ Auth::user()->name }}! 👋</h2>
                        <p class="text-indigo-100 mt-2 text-lg">Selamat datang di pusat kontrol magang Anda.</p>
                    </div>
                    <div class="hidden md:block bg-white/20 p-3 rounded-lg backdrop-blur-sm">
                        <p class="text-sm font-medium">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                    </div>
                </div>
            </div>

            @if (!$application)
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                    <div class="p-8 md:p-12 text-center">
                        <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Anda belum terdaftar di program magang</h3>
                        <p class="text-gray-500 max-w-lg mx-auto mb-8">
                            Periode pendaftaran telah dibuka. Temukan perusahaan impian Anda dan mulailah perjalanan
                            karir Anda hari ini.
                        </p>
                        <a href="{{ route('mahasiswa.lowongan.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-md transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari Lowongan Sekarang
                        </a>
                    </div>
                </div>
            @elseif($application->status == 'pending')
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-8">
                    <div class="border-b border-gray-100 pb-6 mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Status Lamaran</h3>
                        <p class="text-gray-500">Posisi <span
                                class="font-semibold text-indigo-600">{{ $application->vacancy->position }}</span> di
                            {{ $application->vacancy->company->name }}</p>
                    </div>

                    <div class="relative">
                        <div class="absolute left-0 top-1/2 w-full h-1 bg-gray-200 -translate-y-1/2 z-0"></div>
                        <div class="relative z-10 flex justify-between">
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold shadow border-4 border-white">
                                    ✓</div>
                                <div class="mt-2 text-sm font-bold text-gray-700">Terkirim</div>
                                <div class="text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($application->apply_date)->format('d M') }}</div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-10 h-10 bg-yellow-400 text-white rounded-full flex items-center justify-center font-bold shadow border-4 border-white animate-pulse">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="mt-2 text-sm font-bold text-yellow-600">Review Admin</div>
                                <div class="text-xs text-gray-400">Sedang diproses</div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-10 h-10 bg-gray-200 text-gray-400 rounded-full flex items-center justify-center font-bold shadow border-4 border-white">
                                    3</div>
                                <div class="mt-2 text-sm font-bold text-gray-400">Keputusan</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 bg-yellow-50 border border-yellow-100 rounded-lg p-4 flex gap-3">
                        <svg class="w-6 h-6 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-yellow-800">Berkas Anda sedang ditinjau oleh Koordinator. Mohon cek
                            secara berkala, notifikasi akan muncul di sini.</p>
                    </div>
                </div>
            @elseif($application->status == 'rejected')
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl border-l-4 border-red-500 p-8">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Lamaran Belum Diterima</h3>
                            <p class="text-gray-600 mt-1">
                                Posisi: <span class="font-semibold">{{ $application->vacancy->position }}</span> di
                                {{ $application->vacancy->company->name }}
                            </p>

                            @if ($application->notes)
                                <div class="mt-4 bg-red-50 p-4 rounded-lg border border-red-100">
                                    <p class="text-xs text-red-500 font-bold uppercase tracking-wide mb-1">Catatan
                                        Evaluasi:</p>
                                    <p class="text-red-800 italic">"{{ $application->notes }}"</p>
                                </div>
                            @endif

                            <div class="mt-6">
                                <a href="{{ route('mahasiswa.lowongan.index') }}"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                                    Cari Peluang Lain
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($application->status == 'approved')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Status Magang: AKTIF</h3>
                                <p class="text-gray-500 text-sm">Anda sedang menjalani periode magang.</p>
                            </div>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Sedang Aktif
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <div class="text-xs text-gray-500 uppercase font-bold">Perusahaan</div>
                                <div class="text-lg font-semibold text-indigo-700 mt-1">
                                    {{ $application->vacancy->company->name }}</div>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <div class="text-xs text-gray-500 uppercase font-bold">Posisi</div>
                                <div class="text-lg font-semibold text-gray-800 mt-1">
                                    {{ $application->vacancy->position }}</div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-100 flex flex-wrap gap-3">
                            <a href="{{ route('mahasiswa.logbooks.index') }}"
                                class="flex-1 bg-indigo-600 text-white text-center px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium shadow-sm">
                                + Isi Logbook Hari Ini
                            </a>
                            <a href="{{ route('mahasiswa.laporan.index') }}"
                                class="flex-1 bg-white border border-gray-300 text-gray-700 text-center px-4 py-2 rounded-lg hover:bg-gray-50 transition font-medium">
                                Upload Laporan
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Dosen Pembimbing</h3>

                        @if ($application->dosen)
                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xl">
                                    {{ substr($application->dosen->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-gray-800">{{ $application->dosen->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $application->dosen->email }}</div>
                                </div>
                            </div>
                            <button
                                class="w-full bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                Hubungi Dosen
                            </button>
                        @else
                            <div class="text-center py-6 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <p class="text-gray-500 text-sm">Belum di-plotting oleh Admin.</p>
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-3 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Aktivitas</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="p-4 border border-gray-100 rounded-xl text-center">
                                <div class="text-3xl font-bold text-gray-800">
                                    {{ \App\Models\Logbook::where('user_id', Auth::id())->count() }}
                                </div>
                                <div class="text-xs text-gray-500 uppercase mt-1">Total Logbook</div>
                            </div>

                            <div class="p-4 border border-gray-100 rounded-xl text-center">
                                <div class="text-3xl font-bold text-green-600">
                                    {{ \App\Models\Logbook::where('user_id', Auth::id())->where('status', 'approved')->count() }}
                                </div>
                                <div class="text-xs text-gray-500 uppercase mt-1">Logbook Disetujui</div>
                            </div>

                            <div class="p-4 border border-gray-100 rounded-xl text-center">
                                @php
                                    $laporan = \App\Models\Laporan::where('user_id', Auth::id())->first();
                                @endphp
                                <div
                                    class="text-xl font-bold {{ $laporan ? 'text-indigo-600' : 'text-gray-400' }} mt-1">
                                    {{ $laporan ? ucfirst($laporan->status) : 'Belum Upload' }}
                                </div>
                                <div class="text-xs text-gray-500 uppercase mt-2">Status Laporan Akhir</div>
                            </div>

                            <div class="p-4 border border-gray-100 rounded-xl text-center bg-gray-50">
                                <div class="text-3xl font-bold text-gray-800">
                                    {{ $application->final_score ? $application->final_score : '-' }}
                                </div>
                                <div class="text-xs text-gray-500 uppercase mt-1">Nilai Akhir</div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>
</x-app-layout>
