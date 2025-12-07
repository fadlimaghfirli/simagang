<x-app-layout>
    @section('page-title', 'Edit Logbook')

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('mahasiswa.logbooks.index') }}"
                    class="text-gray-500 hover:text-indigo-600 flex items-center gap-2">
                    &larr; Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Catatan Kegiatan</h2>

                <form action="{{ route('mahasiswa.logbooks.update', $logbook->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kegiatan</label>
                        <input type="date" name="date" class="border rounded w-full py-2 px-3"
                            value="{{ $logbook->date }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Uraian Aktivitas</label>
                        <textarea name="activity" rows="5" class="border rounded w-full py-2 px-3" required>{{ $logbook->activity }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Update Dokumentasi (Opsional)</label>
                        @if ($logbook->evidence)
                            <div class="mb-2">
                                <p class="text-xs text-gray-500 mb-1">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $logbook->evidence) }}" class="h-20 rounded border">
                            </div>
                        @endif
                        <input type="file" name="evidence" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti foto.</p>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('mahasiswa.logbooks.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
