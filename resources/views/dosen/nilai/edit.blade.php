<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('dosen.nilai.index') }}" class="text-gray-500 hover:text-gray-700 mb-4 inline-block">&larr;
                Kembali</a>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-1">Form Penilaian</h2>
                <p class="text-gray-500 mb-6">Mahasiswa: <span
                        class="font-bold text-gray-700">{{ $application->user->name }}</span></p>

                <form action="{{ route('dosen.nilai.update', $application->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nilai Bimbingan (0-100)</label>
                            <input type="number" name="score_bimbingan" value="{{ $application->score_bimbingan }}"
                                min="0" max="100"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <p class="text-xs text-gray-500 mt-1">Berdasarkan keaktifan & sikap.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nilai Laporan (0-100)</label>
                            <input type="number" name="score_laporan" value="{{ $application->score_laporan }}"
                                min="0" max="100"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            <p class="text-xs text-gray-500 mt-1">Berdasarkan kualitas laporan akhir.</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded border border-gray-200 mb-6">
                        <p class="text-sm text-gray-600 text-center">Nilai Akhir akan dihitung otomatis rata-rata dari
                            kedua nilai di atas.</p>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded hover:bg-indigo-700 transition">
                        Simpan Nilai Akhir
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
