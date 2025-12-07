<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">

                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Formulir Pengguna Baru</h3>
                    </div>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                                    <x-text-input id="name"
                                        class="block mt-1 w-full bg-gray-50 focus:bg-white transition-colors"
                                        type="text" name="name" :value="old('name')" required autofocus
                                        placeholder="Masukkan Nama Lengkap" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="role" :value="__('Role / Jabatan')" />
                                    <select id="role" name="role"
                                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-gray-50 focus:bg-white">
                                        <option value="" disabled selected>-- Pilih Role --</option>
                                        <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>
                                            Mahasiswa</option>
                                        <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen
                                        </option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                    {{-- <p class="text-xs text-gray-500 mt-1">Pilih "Dosen" untuk memberikan akses panel
                                        staff pengajar.</p> --}}
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="email" :value="__('Alamat Email')" />
                                    <x-text-input id="email"
                                        class="block mt-1 w-full bg-gray-50 focus:bg-white transition-colors"
                                        type="email" name="email" :value="old('email')" required
                                        placeholder="123xxx@trunojoyo.ac.id" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="password" :value="__('Kata Sandi')" />
                                    <x-text-input id="password"
                                        class="block mt-1 w-full bg-gray-50 focus:bg-white transition-colors"
                                        type="password" name="password" required autocomplete="new-password"
                                        placeholder="Masukkan Kata Sandi (minimal 8 Karakter)" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>

                        </div>

                        <div class="mt-8 flex justify-end items-center gap-4 border-t border-gray-100 pt-6">
                            <a href="{{ route('users.index') }}"
                                class="text-gray-600 hover:text-gray-900 text-sm font-medium px-4 py-2">
                                Batal
                            </a>
                            <x-primary-button
                                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                {{ __('Simpan Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
