<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Profil Pengguna') }}
            </h2>
            <a href="{{ route('users.index') }}"
                class="text-gray-500 hover:text-indigo-600 flex items-center gap-2 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Manajemen User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-1">
                        <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden sticky top-8">
                            <div class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600 relative">
                                <div class="absolute top-4 right-4 text-white opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                            <div class="px-6 pb-6 relative">
                                <div class="-mt-12 mb-4">
                                    <div
                                        class="h-24 w-24 rounded-full border-4 border-white bg-white shadow-md flex items-center justify-center text-3xl font-bold text-indigo-600">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500 mb-4">{{ $user->email }}</p>

                                <div class="flex items-center gap-2 mb-6">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Current
                                        Role:</span>
                                    @if ($user->role == 'admin')
                                        <span
                                            class="px-3 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full">Administrator</span>
                                    @elseif($user->role == 'dosen')
                                        <span
                                            class="px-3 py-1 text-xs font-bold text-indigo-700 bg-indigo-100 rounded-full">Dosen
                                            Pengajar</span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-bold text-emerald-700 bg-emerald-100 rounded-full">Mahasiswa</span>
                                    @endif
                                </div>

                                <hr class="border-gray-100 mb-4">

                                <div class="text-xs text-gray-400 space-y-2">
                                    <div class="flex justify-between">
                                        <span>Bergabung:</span>
                                        <span class="text-gray-600">{{ $user->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Terakhir Update:</span>
                                        <span class="text-gray-600">{{ $user->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-6">

                        <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Informasi Akun</h3>
                            <p class="text-sm text-gray-500 mb-6">Perbarui nama lengkap, email, dan peran pengguna.</p>

                            <div class="space-y-5">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                                    <x-text-input id="name"
                                        class="block mt-1 w-full bg-gray-50 focus:bg-white transition-all"
                                        type="text" name="name" :value="old('name', $user->name)" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Alamat Email')" />
                                    <x-text-input id="email"
                                        class="block mt-1 w-full bg-gray-50 focus:bg-white transition-all"
                                        type="email" name="email" :value="old('email', $user->email)" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="role" :value="__('Role Pengguna')" />
                                    <div class="relative mt-1">
                                        <select id="role" name="role"
                                            class="block w-full rounded-lg border-gray-300 py-2.5 pl-3 pr-10 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-gray-50">
                                            <option value="mahasiswa"
                                                {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>
                                                Mahasiswa</option>
                                            <option value="dosen"
                                                {{ old('role', $user->role) == 'dosen' ? 'selected' : '' }}>Dosen
                                            </option>
                                            <option value="admin"
                                                {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                        </select>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Perhatian: Mengubah role akan mengubah hak
                                        akses user ini di sistem.</p>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-amber-50 rounded-lg text-amber-600 hidden sm:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <div class="w-full">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Ubah Password</h3>
                                    <p class="text-sm text-gray-500 mb-4">Kosongkan jika tidak ingin mengganti password
                                        pengguna ini.</p>

                                    <div class="relative">
                                        <x-input-label for="password" :value="__('Password Baru')" />
                                        <x-text-input id="password"
                                            class="block mt-1 w-full border-amber-200 focus:border-amber-500 focus:ring-amber-500"
                                            type="password" name="password" autocomplete="new-password"
                                            placeholder="Hanya isi jika ingin mereset..." />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4">
                            <a href="{{ route('users.index') }}"
                                class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-xl hover:-translate-y-0.5 transition-all">
                                Simpan Perubahan
                            </button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
