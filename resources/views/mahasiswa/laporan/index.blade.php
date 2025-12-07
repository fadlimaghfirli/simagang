<x-app-layout>
    @section('page-title', 'Laporan Akhir')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-2xl font-bold text-gray-800 mb-6 md:hidden">Laporan Akhir Magang</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                @if (!$laporan)
                    <div class="text-center py-10">
                        <div class="bg-indigo-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada laporan</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">Silakan unggah laporan akhir magang Anda dalam
                            format PDF.</p>

                        <form action="{{ route('mahasiswa.laporan.store') }}" method="POST"
                            enctype="multipart/form-data" class="max-w-md mx-auto">
                            @csrf
                            <input type="file" name="file_laporan" accept=".pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 mb-4"
                                required>
                            <button type="submit"
                                class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 transition">
                                Unggah Laporan
                            </button>
                        </form>
                    </div>
                @else
                    <div
                        class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border-b border-gray-100 pb-6 mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">File Laporan Terkirim</h3>
                            <p class="text-gray-500 text-sm">Diunggah: {{ $laporan->updated_at->format('d F Y, H:i') }}
                            </p>
                            <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank"
                                class="text-indigo-600 hover:underline text-sm mt-2 inline-block font-semibold">
                                &darr; Download / Lihat File
                            </a>
                        </div>

                        <div>
                            @if ($laporan->status == 'pending')
                                <span
                                    class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-bold text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Menunggu Pemeriksaan
                                </span>
                            @elseif($laporan->status == 'approved')
                                <span
                                    class="px-4 py-2 rounded-full bg-green-100 text-green-800 font-bold text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Disetujui (Final)
                                </span>
                            @elseif($laporan->status == 'revision')
                                <span
                                    class="px-4 py-2 rounded-full bg-red-100 text-red-800 font-bold text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    Perlu Revisi
                                </span>
                            @endif
                        </div>
                    </div>

                    @if ($laporan->notes)
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <h4 class="font-bold text-red-800 mb-1">Catatan Dosen:</h4>
                            <p class="text-gray-700">"{{ $laporan->notes }}"</p>
                        </div>
                    @endif

                    @if ($laporan->status != 'approved')
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h4 class="font-bold text-gray-800 mb-4">Perbarui Laporan</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm text-gray-600 mb-2">Ingin mengganti file dengan versi baru?</p>
                                    <form action="{{ route('mahasiswa.laporan.update', $laporan->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex gap-2">
                                            <input type="file" name="file_laporan" accept=".pdf"
                                                class="block w-full text-xs text-gray-500 file:mr-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-lg"
                                                required>
                                            <button type="submit"
                                                class="bg-indigo-600 text-white font-bold py-1 px-3 rounded-lg hover:bg-indigo-700 text-sm">
                                                Ganti
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div
                                    class="flex flex-col items-start md:items-end justify-center border-t md:border-t-0 md:border-l border-gray-200 pt-4 md:pt-0 md:pl-6">
                                    <p class="text-sm text-gray-600 mb-2">Atau hapus laporan ini sepenuhnya?</p>
                                    <form action="{{ route('mahasiswa.laporan.destroy', $laporan->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus laporan ini? Anda harus mengupload ulang nanti.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 border border-red-200 bg-white hover:bg-red-50 font-bold py-2 px-4 rounded-lg transition text-sm flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Hapus File Laporan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                            <p class="text-green-800 font-semibold">Laporan Anda sudah disetujui dan dikunci. Tidak
                                dapat diubah lagi.</p>
                        </div>
                    @endif

                @endif

            </div>
        </div>
    </div>
</x-app-layout>
