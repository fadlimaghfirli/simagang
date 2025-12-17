<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Manajemen User
                </h2>

                <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                    <form method="GET" action="{{ route('admin.users.dosen') }}" class="w-full md:w-64">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dosen..."
                                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
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
                        <a href="{{ route('admin.users.dosen.create') }}"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium shadow-sm transition-colors whitespace-nowrap flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Tambah Dosen
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                        Data Dosen
                    </h3>
                    <span class="text-xs font-semibold px-2 py-1 bg-indigo-100 text-indigo-700 rounded">Total:
                        {{ $dosens->total() }}</span>
                </div>
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIP</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Dosen</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($dosens as $dosen)
                            <tr class="hover:bg-gray-50 transition-colors">

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ optional($dosen->dosenProfile)->nip ?? '-' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <div
                                                class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                                {{ substr($dosen->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $dosen->name }}</div>
                                            @if(optional($dosen->dosenProfile)->kode_dosen)
                                            <div class="text-xs text-gray-500">Kode:
                                                {{ $dosen->dosenProfile->kode_dosen }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $dosen->email }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center items-center gap-2">

                                        <a href="{{ route('users.show', $dosen->id) }}"
                                            class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 hover:text-blue-800 transition-colors"
                                            title="Lihat Profil">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('users.destroy', $dosen->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:text-red-800 transition-colors"
                                                title="Hapus Permanen">
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

                            @if ($dosens->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">Belum ada data dosen.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $dosens->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>