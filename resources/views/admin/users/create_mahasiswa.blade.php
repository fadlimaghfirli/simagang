<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mahasiswa Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <input type="hidden" name="role" value="mahasiswa">

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

                        <div class="bg-emerald-50 p-5 rounded-xl border border-emerald-100 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-900 border-b border-emerald-200 pb-2">Data
                                Mahasiswa</h3>

                            <div>
                                <x-input-label for="nim" value="NIM (Nomor Induk Mahasiswa)" />
                                <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim"
                                    :value="old('nim')" placeholder="Contoh: 210411100001" required />
                                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="angkatan" value="Angkatan" />
                                    <x-text-input id="angkatan" class="block mt-1 w-full" type="number" name="angkatan"
                                        :value="old('angkatan')" placeholder="2022" required />
                                    <x-input-error :messages="$errors->get('angkatan')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="kelas" value="Kelas (Opsional)" />
                                    <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas"
                                        :value="old('kelas')" placeholder="A" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="no_hp" value="No. HP (WhatsApp)" />
                                <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp"
                                    :value="old('no_hp')" placeholder="08..." />
                            </div>

                            <div>
                                <x-input-label for="dosen_wali_id" value="Dosen Wali" />
                                <select id="dosen_wali_id" name="dosen_wali_id"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Pilih Dosen Wali --</option>
                                    @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}"
                                        {{ old('dosen_wali_id') == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->name }}
                                        {{ $dosen->dosenProfile ? '('.$dosen->dosenProfile->kode_dosen.')' : '' }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 gap-4">
                        <a href="{{ route('admin.users.mahasiswa') }}"
                            class="text-gray-600 hover:text-gray-900 text-sm font-medium">Batal</a>
                        <button type="submit"
                            class="px-6 py-2 bg-emerald-600 text-white font-semibold rounded-lg shadow-md hover:bg-emerald-700 transition-all">
                            Simpan Mahasiswa
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>