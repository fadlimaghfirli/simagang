<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Mitra & Lowongan
                </h2>

                <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                    <form method="GET" action="{{ route('admin.vacancies.index') }}" class="w-full md:w-64">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari posisi / perusahaan..."
                                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </form>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.vacancies.create') }}"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium shadow-sm transition-colors whitespace-nowrap flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Buat Lowongan
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                        Data Lowongan
                    </h3>
                    <span class="text-xs font-semibold px-2 py-1 bg-indigo-100 text-indigo-700 rounded">
                        Total:
                        {{ $vacancies instanceof \Illuminate\Pagination\LengthAwarePaginator ? $vacancies->total() : $vacancies->count() }}
                    </span>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Perusahaan
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Posisi Magang
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kuota
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($vacancies as $vacancy)
                            <tr class="hover:bg-gray-50 transition-colors">

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <div
                                                class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                                {{ substr($vacancy->company->name ?? '?', 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $vacancy->company->name ?? 'Tidak Ada Perusahaan' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                    {{ $vacancy->position }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $vacancy->quota }} Mahasiswa
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $vacancy->is_active ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                        {{ $vacancy->is_active ? 'Aktif' : 'Tutup' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center items-center gap-2">

                                        @if(Route::has('admin.vacancies.edit'))
                                        <a href="{{ route('admin.vacancies.edit', $vacancy->id) }}"
                                            class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 hover:text-indigo-800 transition-colors"
                                            title="Edit Lowongan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        @endif

                                        <form action="{{ route('admin.vacancies.destroy', $vacancy->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:text-red-800 transition-colors"
                                                title="Hapus Lowongan">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @if ($vacancies->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mb-2"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Belum ada data lowongan magang.
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    @if($vacancies instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="mt-4">
                        {{ $vacancies->appends(request()->query())->links() }}
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>