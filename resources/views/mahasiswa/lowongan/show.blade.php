<x-app-layout>
    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('mahasiswa.lowongan.index', $vacancy->id) }}"
                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 mb-6 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar Lowongan
            </a>

            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-50 p-4 text-red-700 border border-red-200 flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <div class="flex flex-col sm:flex-row gap-6 items-start">
                            <div class="flex-shrink-0">
                                <div
                                    class="h-20 w-20 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-200">
                                    <span class="text-3xl font-bold text-white tracking-wider">
                                        {{ substr($vacancy->company->name, 0, 1) }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex-grow">
                                <h1 class="text-3xl font-bold text-gray-900 leading-tight mb-2">
                                    {{ $vacancy->position }}
                                </h1>
                                <div class="flex items-center gap-2 text-lg text-gray-600 font-medium mb-4">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                    {{ $vacancy->company->name }}
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        Kuota: {{ $vacancy->quota }} Mahasiswa
                                    </span>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                        Magang / Intern
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                            Deskripsi Pekerjaan
                        </h3>

                        <div class="prose prose-indigo max-w-none text-gray-600 leading-relaxed">
                            <div class="whitespace-pre-line">{{ $vacancy->description }}</div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-gray-100">
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Lokasi Kantor</h3>
                            <div class="flex items-start gap-3 text-gray-600 bg-gray-50 p-4 rounded-lg">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <p>{{ $vacancy->company->address }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-6 space-y-6">

                        <div class="bg-white rounded-2xl shadow-lg shadow-indigo-100 border border-indigo-50 p-6">
                            <div class="mb-6">
                                <p class="text-sm text-gray-500 mb-1">Batas Kuota</p>
                                <div class="flex items-end gap-2">
                                    <span class="text-3xl font-bold text-indigo-600">{{ $vacancy->quota }}</span>
                                    <span class="text-gray-600 font-medium mb-1">Posisi Tersedia</span>
                                </div>
                            </div>
                            @php
                                // Cek status user saat ini
                                $hasActiveInternship = \App\Models\Application::where('user_id', auth()->id())
                                    ->whereIn('status', ['approved', 'finished'])
                                    ->exists();

                                // Cek apakah user sudah melamar di lowongan INI
                                $alreadyAppliedThis = \App\Models\Application::where('user_id', auth()->id())
                                    ->where('vacancy_id', $vacancy->id)
                                    ->exists();
                            @endphp
                            @if ($hasActiveInternship)
                                <button disabled
                                    class="block w-full text-center bg-gray-300 text-gray-500 font-bold py-3.5 px-6 rounded-xl cursor-not-allowed">
                                    Anda sedang Aktif Magang
                                </button>
                            @elseif ($alreadyAppliedThis)
                                <button disabled
                                    class="block w-full text-center bg-yellow-100 text-yellow-700 font-bold py-3.5 px-6 rounded-xl cursor-not-allowed border border-yellow-200">
                                    Lamaran Terkirim
                                </button>
                            @elseif ($vacancy->quota <= 0)
                                <button disabled
                                    class="block w-full text-center bg-red-100 text-red-700 font-bold py-3.5 px-6 rounded-xl cursor-not-allowed border border-red-200">
                                    Kuota Penuh
                                </button>
                            @else
                                <a href="{{ route('mahasiswa.applications.create', $vacancy->id) }}"
                                    class="block w-full text-center bg-indigo-600 text-white font-bold py-3.5 px-6 rounded-xl hover:bg-indigo-700 transition-all shadow-md transform hover:-translate-y-0.5">
                                    Lamar Sekarang
                                </a>
                            @endif

                            <p class="text-xs text-center text-gray-400 mt-4">
                                Pastikan profil dan CV Anda sudah diperbarui sebelum melamar.
                            </p>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h4 class="font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100">Informasi Kontak</h4>

                            <ul class="space-y-4">
                                <li class="flex items-start gap-3">
                                    <div class="bg-indigo-50 p-2 rounded-lg text-indigo-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase font-semibold">PIC / HRD</p>
                                        <p class="text-gray-800 font-medium">{{ $vacancy->company->pic ?? '-' }}</p>
                                    </div>
                                </li>

                                <li class="flex items-start gap-3">
                                    <div class="bg-purple-50 p-2 rounded-lg text-purple-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-xs text-gray-500 uppercase font-semibold">Website</p>
                                        @if ($vacancy->company->website)
                                            <a href="{{ $vacancy->company->website }}" target="_blank"
                                                class="text-indigo-600 hover:text-indigo-800 hover:underline font-medium truncate block">
                                                {{ $vacancy->company->website }}
                                            </a>
                                        @else
                                            <p class="text-gray-800">-</p>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>

                        {{-- <div class="bg-yellow-50 rounded-xl p-4 border border-yellow-100">
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                <p class="text-xs text-yellow-800 leading-relaxed">
                                    <strong>Tips Keamanan:</strong> Jangan pernah mentransfer uang untuk alasan apapun
                                    (tiket, akomodasi, biaya pelatihan) selama proses rekrutmen magang.
                                </p>
                            </div>
                        </div> --}}

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
