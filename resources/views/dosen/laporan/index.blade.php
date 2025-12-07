<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Validasi Laporan Akhir</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Upload
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($laporans as $lap)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $lap->updated_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-700">
                                    {{ $lap->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($lap->status == 'pending')
                                        <span
                                            class="px-2 py-1 text-xs font-bold rounded bg-yellow-100 text-yellow-800">Menunggu
                                            Review</span>
                                    @elseif($lap->status == 'approved')
                                        <span
                                            class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-800">Disetujui</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-800">Revisi</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('dosen.laporan.show', $lap->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 font-bold">
                                        Periksa Laporan
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada laporan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
