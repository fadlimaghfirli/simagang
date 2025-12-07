<x-app-layout>
    <div class="min-h-screen py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                    Temukan <span class="text-indigo-600">Peluang Magang</span> Impianmu
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
                    Jelajahi berbagai posisi magang dari perusahaan mitra kami dan mulai karir profesionalmu hari ini.
                </p>

                <div class="max-w-xl mx-auto relative group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg blur opacity-5 group-hover:opacity-15 transition duration-1000 group-hover:duration-200">
                    </div>
                    <form method="GET" action="{{ route('mahasiswa.lowongan.index') }}"
                        class="relative bg-white rounded-lg flex items-center p-2 shadow-sm border border-gray-100">
                        <div class="flex-shrink-0 pl-3 text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full border-none focus:ring-0 text-gray-600 placeholder-gray-400 bg-transparent h-10"
                            placeholder="Cari posisi atau nama perusahaan...">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-indigo-700 transition-colors">
                            Cari
                        </button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition
                    class="mb-8 rounded-lg bg-green-50 p-4 border-l-4 border-green-500 flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 text-green-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-green-900">Berhasil!</p>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" class="text-green-500 hover:text-green-700">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($vacancies as $vacancy)
                    <div
                        class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full overflow-hidden hover:-translate-y-1">

                        <div class="h-1.5 w-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xl shadow-sm border border-indigo-100">
                                        {{ substr($vacancy->company->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3
                                            class="font-bold text-gray-900 text-lg leading-tight group-hover:text-indigo-600 transition-colors">
                                            {{ $vacancy->position }}
                                        </h3>
                                        <p class="text-sm text-gray-500 font-medium">{{ $vacancy->company->name }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 mb-5">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                    Magang
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $vacancy->quota > 0 ? 'bg-green-50 text-green-700 border-green-100' : 'bg-red-50 text-red-700 border-red-100' }}">
                                    {{ $vacancy->quota > 0 ? $vacancy->quota . ' Kuota' : 'Penuh' }}
                                </span>
                            </div>

                            <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-1">
                                {{ $vacancy->description }}
                            </p>

                            <div class="flex items-center text-gray-500 text-xs mb-6 bg-gray-50 p-2 rounded-lg">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="truncate">{{ $vacancy->company->address }}</span>
                            </div>

                            <a href="{{ route('mahasiswa.lowongan.show', $vacancy->id) }}" class="block w-full">
                                <button
                                    class="w-full py-2.5 px-4 bg-white border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition-all duration-300 flex items-center justify-center gap-2 group-hover:shadow-md">
                                    Lihat Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-16 px-4 text-center">
                        <div class="bg-indigo-50 rounded-full p-6 mb-4">
                            <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Tidak ada lowongan ditemukan</h3>
                        <p class="text-gray-500 max-w-sm mx-auto">
                            Coba ubah kata kunci pencarian Anda atau cek kembali nanti untuk peluang terbaru.
                        </p>
                        <a href="{{ route('mahasiswa.lowongan.index') }}"
                            class="mt-6 text-indigo-600 hover:text-indigo-800 font-medium">
                            Reset Pencarian
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 flex justify-center">
                {{ $vacancies->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
