<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Dosen Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <input type="hidden" name="role" value="dosen">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Informasi Akun</h3>

                            <div>
                                <x-input-label for="name" :value="__('Nama Lengkap')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 space-y-4">
                            <h3 class="text-lg font-medium text-indigo-900 border-b border-indigo-200 pb-2">Data Dosen
                            </h3>

                            <div>
                                <x-input-label for="nip" value="NIP (Nomor Induk Pegawai)" />
                                <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip"
                                    :value="old('nip')" placeholder="1987..." required />
                                <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nidn" value="NIDN (Opsional)" />
                                <x-text-input id="nidn" class="block mt-1 w-full" type="text" name="nidn"
                                    :value="old('nidn')" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="kode_dosen" value="Kode Dosen" />
                                    <x-text-input id="kode_dosen" class="block mt-1 w-full" type="text"
                                        name="kode_dosen" :value="old('kode_dosen')" placeholder="Contoh: FD" />
                                </div>
                                <div>
                                    <x-input-label for="no_hp" value="No. HP" />
                                    <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp"
                                        :value="old('no_hp')" placeholder="08..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 gap-4">
                        <a href="{{ route('admin.users.dosen') }}"
                            class="text-gray-600 hover:text-gray-900 text-sm font-medium">Batal</a>
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all">
                            Simpan Dosen
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>