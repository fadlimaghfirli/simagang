<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Input Nilai Mahasiswa</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nilai Bimbingan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nilai Laporan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nilai Akhir</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($applications as $app)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $app->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $app->vacancy->company->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $app->score_bimbingan ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $app->score_laporan ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-indigo-600">
                                    {{ $app->final_score ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    {{-- CEK STATUS LAPORAN --}}
                                    @if ($app->laporan && $app->laporan->status == 'approved')
                                        {{-- JIKA SUDAH ACC: TAMPILKAN TOMBOL INPUT NILAI --}}
                                        <a href="{{ route('dosen.nilai.edit', $app->id) }}"
                                            class="text-white bg-indigo-600 px-3 py-1.5 rounded hover:bg-indigo-700 shadow-sm transition">
                                            Input Nilai
                                        </a>
                                    @elseif($app->laporan)
                                        {{-- JIKA SUDAH UPLOAD TAPI BELUM ACC --}}
                                        <span class="text-yellow-600 bg-yellow-100 px-2 py-1 rounded text-xs font-bold">
                                            Laporan Belum ACC
                                        </span>
                                        <div class="text-xs text-gray-400 mt-1">
                                            <a href="{{ route('dosen.laporan.show', $app->laporan->id) }}"
                                                class="hover:text-indigo-600 underline">
                                                Cek Laporan
                                            </a>
                                        </div>
                                    @else
                                        {{-- JIKA BELUM UPLOAD SAMA SEKALI --}}
                                        <span class="text-gray-500 italic text-xs">
                                            Belum Upload Laporan
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
