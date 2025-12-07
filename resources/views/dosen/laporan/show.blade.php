<x-app-layout>
    <div class="py-12 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('dosen.laporan.index') }}"
                class="inline-flex items-center text-gray-500 hover:text-indigo-600 mb-6 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar Laporan
            </a>

            <div
                class="bg-white shadow-sm rounded-xl p-6 mb-6 border border-gray-100 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $laporan->user->name }}</h1>
                    <p class="text-gray-500 text-sm mt-1">
                        Program Studi Informatika &bull; {{ $laporan->user->email }}
                    </p>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-400 uppercase font-bold tracking-wider">Tanggal Upload</div>
                    <div class="text-lg font-semibold text-indigo-600">
                        {{ $laporan->updated_at->format('l, d F Y') }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <h3 class="font-bold text-gray-700">File Laporan Akhir</h3>
                            </div>

                            <a href="{{ asset('storage/' . $laporan->file_path) }}" download
                                class="text-xs font-bold text-indigo-600 hover:underline flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download PDF
                            </a>
                        </div>

                        <div class="p-2">
                            <div class="bg-gray-100 rounded-lg border border-gray-200 h-[600px]">
                                <embed src="{{ asset('storage/' . $laporan->file_path) }}#toolbar=0"
                                    type="application/pdf" width="100%" height="100%"
                                    class="w-full h-full rounded-lg">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-6 bg-white shadow-lg rounded-xl border border-indigo-100 overflow-hidden">

                        <div class="bg-indigo-600 px-6 py-4">
                            <h3 class="font-bold text-white flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Validasi Dosen
                            </h3>
                        </div>

                        <div class="p-6">
                            <form action="{{ route('dosen.laporan.update', $laporan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-5">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Keputusan</label>
                                    <div class="relative">
                                        <select name="status"
                                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="approved"
                                                {{ $laporan->status == 'approved' ? 'selected' : '' }}>Setujui (ACC)
                                            </option>
                                            <option value="revision"
                                                {{ $laporan->status == 'revision' ? 'selected' : '' }}>Minta Revisi
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Revisi</label>
                                    <textarea name="notes" rows="6"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Berikan detail bagian mana yang harus diperbaiki...">{{ $laporan->notes }}</textarea>
                                </div>

                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    Simpan Keputusan
                                </button>
                            </form>
                        </div>

                        <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-center">
                            <span class="text-xs text-gray-500">Status saat ini:</span>
                            @if ($laporan->status == 'approved')
                                <span class="text-xs font-bold text-green-600">DISETUJUI</span>
                            @elseif($laporan->status == 'revision')
                                <span class="text-xs font-bold text-red-600">REVISI</span>
                            @else
                                <span class="text-xs font-bold text-yellow-600">PENDING</span>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
