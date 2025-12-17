<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Data Dosen') }}
            </h2>
            <a href="{{ route('admin.users.dosen') }}"
                class="text-gray-500 hover:text-indigo-600 flex items-center gap-2 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Dosen
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
                            <div class="h-24 bg-gradient-to-r from-indigo-500 to-purple-600 relative"></div>
                            <div class="px-6 pb-6 relative">
                                <div class="-mt-10 mb-3">
                                    <div
                                        class="h-20 w-20 rounded-full border-4 border-white bg-indigo-50 flex items-center justify-center text-2xl font-bold text-indigo-600">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $user->name }}</h3>
                                <p class="text-xs text-gray-500 mb-3">{{ $user->email }}</p>
                                <span
                                    class="px-3 py-1 text-xs font-bold text-indigo-700 bg-indigo-100 rounded-full">Dosen
                                    Pengajar</span>
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
                        <div class="bg-indigo-50 shadow-sm rounded-2xl border border-indigo-100 p-6 h-full">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-white rounded-lg text-indigo-600 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .883-.393 1.627-1 2.138A2.25 2.25 0 0110 8h4a2.25 2.25 0 01-1 2.138c-.607-.51-1-1.255-1-2.138z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-indigo-900">Informasi Akademik Dosen</h3>
                                    <p class="text-sm text-indigo-600">Lengkapi data NIP, NIDN, dan informasi lainnya.
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-1 md:col-span-2">
                                    <x-input-label for="nip" value="NIP (Nomor Induk Pegawai)" />
                                    <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip"
                                        :value="old('nip', optional($user->dosenProfile)->nip)" required />
                                    <x-input-error :messages="$errors->get('nip')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="nidn" value="NIDN" />
                                    <x-text-input id="nidn" class="block mt-1 w-full" type="text" name="nidn"
                                        :value="old('nidn', optional($user->dosenProfile)->nidn)" />
                                    <x-input-error :messages="$errors->get('nidn')" class="mt-1" />
                                </div>

                                <div>
                                    <x-input-label for="kode_dosen" value="Kode Dosen (Inisial)" />
                                    <x-text-input id="kode_dosen" class="block mt-1 w-full" type="text"
                                        name="kode_dosen"
                                        :value="old('kode_dosen', optional($user->dosenProfile)->kode_dosen)" />
                                </div>

                                <div>
                                    <x-input-label for="no_hp" value="Nomor Handphone" />
                                    <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp"
                                        :value="old('no_hp', optional($user->dosenProfile)->no_hp)" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-indigo-200">
                                <a href="{{ route('admin.users.dosen') }}"
                                    class="px-5 py-2.5 rounded-lg border border-indigo-200 text-indigo-700 text-sm font-medium hover:bg-white transition-colors">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-bold shadow-md hover:bg-indigo-700 transition-all">
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