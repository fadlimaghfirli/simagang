@php
    // Cek apakah user yang sedang login memiliki lamaran dengan status 'approved'
    $isMagang = \App\Models\Application::where('user_id', Auth::id())->where('status', 'approved')->exists();
@endphp

<div class="flex flex-col w-64 h-full bg-white border-r border-gray-200">

    <div class="flex-1 overflow-y-auto py-4">
        <nav class="px-4 space-y-2">

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-2">
                Menu Mahasiswa
            </div>

            <a href="{{ route('mahasiswa.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors duration-200 
               {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-indigo-50 text-indigo-600 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('mahasiswa.lowongan.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors duration-200 
   {{ request()->routeIs('mahasiswa.lowongan.*') ? 'bg-indigo-50 text-indigo-600 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
                Info Lowongan
            </a>

            @if ($isMagang)
                <a href="{{ route('mahasiswa.logbooks.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors duration-200 
   {{ request()->routeIs('mahasiswa.logbooks.*') ? 'bg-indigo-50 text-indigo-600 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Logbook Kegiatan
                </a>

                {{-- <a href="#"
                    class="flex items-center gap-3 px-4 py-2 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                    Bimbingan
                </a> --}}

                <a href="{{ route('mahasiswa.laporan.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors duration-200 
   {{ request()->routeIs('mahasiswa.laporan.*') ? 'bg-indigo-50 text-indigo-600 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Laporan Akhir
                </a>

                <a href="{{ route('mahasiswa.nilai.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors duration-200 
   {{ request()->routeIs('mahasiswa.nilai.*') ? 'bg-indigo-50 text-indigo-600 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Nilai Magang
                </a>
            @endif

        </nav>
    </div>

    {{-- <div class="p-4 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex w-full items-center gap-3 px-4 py-2 text-red-600 rounded-lg hover:bg-red-50 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                Logout
            </button>
        </form>
        <div class="mt-4 flex items-center gap-3 px-4">
            <div
                class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-600">
                M
            </div>
            <div class="text-sm">
                <p class="font-medium text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">Mahasiswa</p>
            </div>
        </div>
    </div> --}}
</div>
