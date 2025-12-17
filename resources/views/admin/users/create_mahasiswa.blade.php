<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <input type="hidden" name="role" value="mahasiswa">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <div class="space-y-6">
                        <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                                <div class="bg-emerald-100 rounded-lg p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none"
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
                                        :value="old('name')" required autofocus placeholder="Contoh: Ahmad Fauzi" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Alamat Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required placeholder="mhs@kampus.ac.id" />
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

                        {{-- Info box (Optional, disamakan strukturnya jika ingin diaktifkan) --}}
                        {{-- <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4 flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-emerald-700 leading-relaxed">
                                Pastikan data yang diinputkan sesuai dengan PDDIKTI.
                            </p>
                        </div> --}}
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                                <div class="bg-emerald-100 rounded-lg p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-gray-800">Data Akademik Mahasiswa</h3>
                            </div>

                            <div class="p-6 space-y-5">
                                <div>
                                    <x-input-label for="nim" value="NIM (Nomor Induk Mahasiswa)" />
                                    <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim"
                                        :value="old('nim')" placeholder="Contoh: 210411100xxx" required />
                                    <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="angkatan" value="Angkatan" />
                                        <x-text-input id="angkatan" class="block mt-1 w-full" type="number"
                                            name="angkatan" :value="old('angkatan')" placeholder="2023" required />
                                        <x-input-error :messages="$errors->get('angkatan')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="kelas" value="Kelas" />
                                        <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas"
                                            :value="old('kelas')" placeholder="A" />
                                        <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="no_hp" value="No. WhatsApp / HP" />
                                    <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp"
                                        :value="old('no_hp')" placeholder="08xxxxxx" />
                                </div>

                                <div>
                                    <x-input-label for="dosen_wali_id" value="Dosen Wali" />
                                    <select id="dosen_wali_id" name="dosen_wali_id"
                                        class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">
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

                        <div class="flex items-center justify-end gap-3 mt-4">
                            <a href="{{ route('admin.users.mahasiswa') }}"
                                class="px-5 py-2.5 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition-colors shadow-sm">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-5 py-2.5 bg-emerald-600 text-white font-semibold rounded-lg shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition-all flex items-center gap-2">
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