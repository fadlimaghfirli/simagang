<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Data Mahasiswa') }}
            </h2>
            <a href="{{ route('admin.users.mahasiswa') }}"
                class="text-gray-500 hover:text-indigo-600 flex items-center gap-2 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Mahasiswa
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
                            <div class="h-24 bg-gradient-to-r from-emerald-500 to-teal-600 relative"></div>
                            <div class="px-6 pb-6 relative">
                                <div class="-mt-10 mb-3">
                                    <div
                                        class="h-20 w-20 rounded-full border-4 border-white bg-emerald-50 flex items-center justify-center text-2xl font-bold text-emerald-600">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $user->name }}</h3>
                                <p class="text-xs text-gray-500 mb-3">{{ $user->email }}</p>
                                <span
                                    class="px-3 py-1 text-xs font-bold text-emerald-700 bg-emerald-100 rounded-full">Mahasiswa</span>
                            </div>
                        </div>

                        <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">
                            <h3 class="text-sm font-bold text-gray-800 mb-4 border-b pb-2">Akun Login</h3>
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                                    <x-text-input id="name" class="block mt-1 w-full bg-gray-50 focus:bg-white"
                                        type="text" name="name" :value="old('name', $user->name)" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                </div>
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full bg-gray-50 focus:bg-white"
                                        type="email" name="email" :value="old('email', $user->email)" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                </div>
                                <div>
                                    <x-input-label for="password" :value="__('Password Baru (Opsional)')" />
                                    <x-text-input id="password"
                                        class="block mt-1 w-full border-amber-200 focus:border-amber-500"
                                        type="password" name="password" placeholder="Isi untuk mereset..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="bg-emerald-50 shadow-sm rounded-2xl border border-emerald-100 p-6 h-full">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-white rounded-lg text-emerald-600 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-emerald-900">Informasi Mahasiswa</h3>
                                    <p class="text-sm text-emerald-600">Lengkapi data NIM, Angkatan, dan Dosen Wali.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-1 md:col-span-2">
                                    <x-input-label for="nim" value="NIM (Nomor Induk Mahasiswa)" />
                                    <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim"
                                        :value="old('nim', optional($user->mahasiswaProfile)->nim)" required />
                                    <x-input-error :messages="$errors->get('nim')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="angkatan" value="Angkatan" />
                                    <x-text-input id="angkatan" class="block mt-1 w-full" type="number" name="angkatan"
                                        :value="old('angkatan', optional($user->mahasiswaProfile)->angkatan)"
                                        required />
                                    <x-input-error :messages="$errors->get('angkatan')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="kelas" value="Kelas" />
                                    <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas"
                                        :value="old('kelas', optional($user->mahasiswaProfile)->kelas)" />
                                </div>

                                <div>
                                    <x-input-label for="no_hp" value="Nomor Handphone" />
                                    <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp"
                                        :value="old('no_hp', optional($user->mahasiswaProfile)->no_hp)" />
                                </div>

                                <div>
                                    <x-input-label for="dosen_wali_id" value="Dosen Wali" />
                                    <select id="dosen_wali_id" name="dosen_wali_id"
                                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">-- Pilih Dosen Wali --</option>
                                        @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->id }}"
                                            {{ old('dosen_wali_id', optional($user->mahasiswaProfile)->dosen_wali_id) == $dosen->id ? 'selected' : '' }}>
                                            {{ $dosen->name }}
                                            {{ $dosen->dosenProfile ? '('.$dosen->dosenProfile->kode_dosen.')' : '' }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-emerald-200">
                                <a href="{{ route('admin.users.mahasiswa') }}"
                                    class="px-5 py-2.5 rounded-lg border border-emerald-200 text-emerald-700 text-sm font-medium hover:bg-white transition-colors">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-5 py-2.5 rounded-lg bg-emerald-600 text-white text-sm font-bold shadow-md hover:bg-emerald-700 transition-all">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>