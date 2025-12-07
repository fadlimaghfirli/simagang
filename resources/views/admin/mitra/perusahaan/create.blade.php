<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Tambah Perusahaan</h2>

                <form action="{{ route('admin.companies.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Perusahaan</label>
                        <input type="text" name="name" class="border rounded w-full py-2 px-3" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" class="border rounded w-full py-2 px-3">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Alamat</label>
                        <textarea name="address" class="border rounded w-full py-2 px-3" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama PIC</label>
                        <input type="text" name="pic" class="border rounded w-full py-2 px-3">
                    </div>

                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
