<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Buat Lowongan Baru</h2>

                <form action="{{ route('admin.vacancies.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Perusahaan Penyedia</label>
                        <select name="company_id" class="border rounded w-full py-2 px-3">
                            <option value="">-- Pilih Perusahaan --</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Posisi Magang</label>
                        <input type="text" name="position" class="border rounded w-full py-2 px-3"
                            placeholder="Contoh: Frontend Developer" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Kuota Penerimaan</label>
                        <input type="number" name="quota" class="border rounded w-full py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Deskripsi Pekerjaan</label>
                        <textarea name="description" rows="4" class="border rounded w-full py-2 px-3" required></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Simpan
                            Lowongan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
