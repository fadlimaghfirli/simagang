<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <input type="hidden" name="role" value="dosen">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <div class="space-y-6">
                        <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                                <div class="bg-indigo-100 rounded-lg p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-gray-800">Informasi Akun Login</h3>
                            </div>

                            <div class="p-6 space-y-5">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name')" required autofocus
                                        placeholder="Contoh: Dr. Budi Santoso, M.Kom" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Alamat Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required placeholder="email@kampus.ac.id" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="block mt-1 w-full" type="password"
                                        name="password" required placeholder="Minimal 8 karakter" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-blue-700 leading-relaxed">
                                Pastikan email aktif karena akan digunakan untuk login dan notifikasi sistem. Password
                                default dapat diubah oleh Dosen setelah login pertama kali.
                            </p>
                        </div> --}}
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                                <div class="bg-green-100 rounded-lg p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-gray-800">Data Akademik Dosen</h3>
                            </div>

                            <div class="p-6 space-y-5">
                                <div>
                                    <x-input-label for="nip" value="NIP (Nomor Induk Pegawai)" />
                                    <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip"
                                        :value="old('nip')" placeholder="198xxxxxx" required />
                                    <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="nidn" value="NIDN (Opsional)" />
                                    <x-text-input id="nidn" class="block mt-1 w-full" type="text" name="nidn"
                                        :value="old('nidn')" placeholder="00xxxxxx" />
                                    <p class="text-xs text-gray-400 mt-1">Nomor Induk Dosen Nasional</p>
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="kode_dosen" value="Kode Dosen" />
                                        <x-text-input id="kode_dosen" class="block mt-1 w-full" type="text"
                                            name="kode_dosen" :value="old('kode_dosen')" placeholder="Contoh: FD" />
                                        <x-input-error :messages="$errors->get('kode_dosen')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="no_hp" value="No. WhatsApp / HP" />
                                        <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp"
                                            :value="old('no_hp')" placeholder="08xxxxxx" />
                                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 mt-4">
                            <a href="{{ route('admin.users.dosen') }}"
                                class="px-5 py-2.5 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition-colors shadow-sm">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Data
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>