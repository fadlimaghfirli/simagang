<x-app-layout>
    @section('page-title', 'Dashboard Dosen')

    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-3xl font-bold">Halo, {{ Auth::user()->name }}! 👋</h2>
                        <p class="text-indigo-100 mt-2 text-lg">Berikut adalah ringkasan aktivitas bimbingan Anda hari
                            ini.</p>
                    </div>
                    <div class="hidden md:block bg-white/20 p-3 rounded-lg backdrop-blur-sm">
                        <p class="text-sm font-medium">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Total Mahasiswa</p>
                        <p class="text-4xl font-extrabold text-gray-800 mt-2">{{ $totalMahasiswa }}</p>
                        <a href="{{ route('dosen.mahasiswa.index') }}"
                            class="text-sm text-indigo-600 hover:underline mt-2 inline-block">Lihat semua &rarr;</a>
                    </div>
                    <div class="p-4 bg-indigo-50 rounded-full text-indigo-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition relative overflow-hidden">
                    @if ($pendingLogbooks > 0)
                        <div class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full animate-ping m-2"></div>
                    @endif
                    <div>
                        <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Logbook Baru</p>
                        <p
                            class="text-4xl font-extrabold {{ $pendingLogbooks > 0 ? 'text-red-600' : 'text-gray-800' }} mt-2">
                            {{ $pendingLogbooks }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">Menunggu validasi</p>
                    </div>
                    <div
                        class="p-4 {{ $pendingLogbooks > 0 ? 'bg-red-50 text-red-600' : 'bg-gray-50 text-gray-400' }} rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                    </div>
                    <a href="{{ route('dosen.logbooks.index') }}" class="absolute inset-0"></a>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition relative">
                    @if ($pendingLaporans > 0)
                        <div class="absolute top-0 right-0 w-3 h-3 bg-yellow-500 rounded-full animate-ping m-2"></div>
                    @endif
                    <div>
                        <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Laporan Akhir</p>
                        <p
                            class="text-4xl font-extrabold {{ $pendingLaporans > 0 ? 'text-yellow-600' : 'text-gray-800' }} mt-2">
                            {{ $pendingLaporans }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">Siap diperiksa</p>
                    </div>
                    <div
                        class="p-4 {{ $pendingLaporans > 0 ? 'bg-yellow-50 text-yellow-600' : 'bg-gray-50 text-gray-400' }} rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <a href="{{ route('dosen.laporan.index') }}" class="absolute inset-0"></a>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Mahasiswa Bimbingan (Terbaru)</h3>
                        <a href="{{ route('dosen.mahasiswa.index') }}"
                            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Lihat Semua</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Mahasiswa</th>
                                    <th class="px-6 py-3">Perusahaan</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentStudents as $student)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900 flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                                {{ substr($student->user->name, 0, 1) }}
                                            </div>
                                            {{ $student->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $student->vacancy->company->name }}
                                            <div class="text-xs text-gray-400">{{ $student->vacancy->position }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="mailto:{{ $student->user->email }}"
                                                class="text-gray-400 hover:text-indigo-600" title="Kirim Email">
                                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-400">Belum ada
                                            mahasiswa bimbingan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">

                    <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">
                        <h3 class="font-bold text-gray-800 mb-4">Akses Cepat</h3>
                        <div class="space-y-3">
                            <a href="{{ route('dosen.logbooks.index') }}"
                                class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-indigo-50 hover:text-indigo-700 transition group">
                                <span
                                    class="w-8 h-8 rounded-full bg-white text-indigo-600 flex items-center justify-center shadow-sm mr-3 group-hover:bg-indigo-600 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                        </path>
                                    </svg>
                                </span>
                                <span class="font-medium text-sm">Periksa Logbook</span>
                            </a>
                            <a href="{{ route('dosen.laporan.index') }}"
                                class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-indigo-50 hover:text-indigo-700 transition group">
                                <span
                                    class="w-8 h-8 rounded-full bg-white text-indigo-600 flex items-center justify-center shadow-sm mr-3 group-hover:bg-indigo-600 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="font-medium text-sm">Validasi Laporan</span>
                            </a>
                            <a href="{{ route('dosen.nilai.index') }}"
                                class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-indigo-50 hover:text-indigo-700 transition group">
                                <span
                                    class="w-8 h-8 rounded-full bg-white text-indigo-600 flex items-center justify-center shadow-sm mr-3 group-hover:bg-indigo-600 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="font-medium text-sm">Input Nilai</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
