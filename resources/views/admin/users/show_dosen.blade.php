<x-app-layout>

    <div class="py-12" x-data="{ isEditing: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.users.dosen') }}"
                class="mb-6 text-gray-500 hover:text-indigo-600 flex items-center gap-2 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Dosen
            </a>
            @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition
                class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg relative flex items-center shadow-sm"
                role="alert">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg @click="show = false"
                        class="fill-current h-6 w-6 text-green-500 cursor-pointer hover:text-green-700" role="button"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-1 space-y-6">

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 relative">
                            <div class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
                            <div class="px-6 pb-6 text-center relative">
                                <div class="relative -mt-16 mb-4 inline-block">
                                    <div
                                        class="h-32 w-32 rounded-full border-4 border-white bg-white shadow-md flex items-center justify-center text-indigo-600 font-bold text-4xl overflow-hidden">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </div>

                                <h3 class="font-bold text-xl text-gray-900 mb-1">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500 mb-4">{{ $user->email }}</p>

                                <div class="flex justify-center gap-2 mb-6">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-700 uppercase tracking-wide border border-indigo-200">
                                        {{ $user->role }}
                                    </span>
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 uppercase tracking-wide border border-green-200">
                                        Aktif
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 gap-3">
                                    <button type="button" x-show="!isEditing" x-on:click="isEditing = true"
                                        class="w-full py-2.5 px-4 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 text-sm font-medium transition-colors shadow-lg shadow-indigo-200 flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Edit Data
                                    </button>

                                    <div x-show="isEditing" class="grid grid-cols-2 gap-3" style="display: none;">
                                        <button type="button" x-on:click="window.location.reload()"
                                            class="w-full py-2.5 px-4 bg-white text-gray-700 border border-gray-300 rounded-xl hover:bg-gray-50 text-sm font-medium transition-colors">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="w-full py-2.5 px-4 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 text-sm font-medium transition-colors shadow-lg shadow-indigo-200">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                            <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wider">Metadata</h4>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs text-gray-400">Bergabung Sejak</p>
                                    <p class="text-sm font-medium text-gray-700">
                                        {{ $user->created_at->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Terakhir Diupdate</p>
                                    <p class="text-sm font-medium text-gray-700">
                                        {{ $user->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="lg:col-span-2 space-y-6">

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                            <div
                                class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                    Informasi Akun
                                </h3>
                                <span x-show="isEditing"
                                    class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded animate-pulse">
                                    Mode Edit Aktif
                                </span>
                            </div>
                            <div class="p-6 grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                                    <x-text-input id="name" name="name" type="text"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('name', $user->name)" required ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Alamat Email')" />
                                    <x-text-input id="email" name="email" type="email"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('email', $user->email)" required ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <div x-show="isEditing" x-transition.opacity style="display: none;">
                                    <x-input-label for="password" :value="__('Password Baru (Opsional)')" />
                                    <x-text-input id="password" name="password" type="password"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Kosongkan jika tidak ingin mengganti password" />
                                    <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    </svg>
                                    Data Akademik
                                </h3>
                            </div>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div>
                                    <x-input-label for="nip" :value="__('Nomor Induk Pegawai (NIP)')" />
                                    <x-text-input id="nip" name="nip" type="text"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('nip', $user->dosenProfile->nip ?? '')" ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('nip')" />
                                </div>

                                <div>
                                    <x-input-label for="nidn" :value="__('NIDN')" />
                                    <x-text-input id="nidn" name="nidn" type="text"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('nidn', $user->dosenProfile->nidn ?? '')" ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('nidn')" />
                                </div>

                                <div>
                                    <x-input-label for="kode_dosen" :value="__('Kode Dosen')" />
                                    <x-text-input id="kode_dosen" name="kode_dosen" type="text"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('kode_dosen', $user->dosenProfile->kode_dosen ?? '')"
                                        ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('kode_dosen')" />
                                </div>

                                <div>
                                    <x-input-label for="no_hp" :value="__('Nomor WhatsApp / HP')" />
                                    <x-text-input id="no_hp" name="no_hp" type="text"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('no_hp', $user->dosenProfile->no_hp ?? '')" ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>