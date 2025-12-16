<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Daftar Mahasiswa
                </h2>

                <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                    <form method="GET" action="{{ route('admin.users.mahasiswa') }}" class="w-full md:w-64">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari mahasiswa..."
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
                        <a href="{{ route('users.create') }}"
                            class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-medium shadow-sm transition-colors whitespace-nowrap">
                            + Tambah Mahasiswa
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                        Data Mahasiswa
                    </h3>
                    <span class="text-xs font-semibold px-2 py-1 bg-emerald-100 text-emerald-700 rounded">Total:
                        {{ $mahasiswas->total() }}</span>
                </div>
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bergabung</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($mahasiswas as $mhs)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold">
                                                {{ substr($mhs->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $mhs->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mhs->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $mhs->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('users.edit', $user = $mhs->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <form action="{{ route('users.destroy', $mhs->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Yakin hapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 font-medium hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if ($mahasiswas->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">Data mahasiswa tidak
                                    ditemukan.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $mahasiswas->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>