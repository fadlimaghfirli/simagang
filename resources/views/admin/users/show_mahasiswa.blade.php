<x-app-layout>

    <div class="py-12" x-data="{ isEditing: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.users.mahasiswa') }}"
                class="mb-6 text-gray-500 hover:text-emerald-600 flex items-center gap-2 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Mahasiswa
            </a>

            @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition
                class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg relative flex items-center shadow-sm"
                role="alert">
                <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg @click="show = false"
                        class="fill-current h-6 w-6 text-emerald-500 cursor-pointer hover:text-emerald-700"
                        role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
                            {{-- <div class="h-32 bg-gradient-to-r from-emerald-500 to-teal-600"></div> --}}
                            <div class="mt-8 px-6 pb-6 text-center relative">
                                <div class="relative -mt-16 mb-4 inline-block">
                                    <div
                                        class="h-32 w-32 rounded-full border-4 border-white bg-white shadow-md flex items-center justify-center text-emerald-600 font-bold text-4xl overflow-hidden">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </div>

                                <h3 class="font-bold text-xl text-gray-900 mb-1">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500 mb-4">{{ $user->email }}</p>

                                <div class="flex justify-center gap-2 mb-6">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700 uppercase tracking-wide border border-emerald-200">
                                        Mahasiswa
                                    </span>
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 uppercase tracking-wide border border-green-200">
                                        Aktif
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 gap-3">
                                    <button type="button" x-show="!isEditing" x-on:click="isEditing = true"
                                        class="w-full py-2.5 px-4 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 text-sm font-medium transition-colors shadow-lg shadow-emerald-200 flex items-center justify-center gap-2">
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
                                            class="w-full py-2.5 px-4 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 text-sm font-medium transition-colors shadow-lg shadow-emerald-200">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                    Informasi Akun
                                </h3>
                                <span x-show="isEditing"
                                    class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded animate-pulse">
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
                                        class="mt-1 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="Kosongkan jika tidak ingin mengganti password" />
                                    <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    </svg>
                                    Data Akademik Mahasiswa
                                </h3>
                            </div>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div>
                                    <x-input-label for="nim" :value="__('NIM')" />
                                    <x-text-input id="nim" name="nim" type="text"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('nim', $user->mahasiswaProfile->nim ?? '')" ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('nim')" />
                                </div>

                                <div>
                                    <x-input-label for="angkatan" :value="__('Tahun Angkatan')" />
                                    <x-text-input id="angkatan" name="angkatan" type="number"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('angkatan', $user->mahasiswaProfile->angkatan ?? '')"
                                        ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('angkatan')" />
                                </div>

                                <div>
                                    <x-input-label for="kelas" :value="__('Kelas')" />
                                    <x-text-input id="kelas" name="kelas" type="text"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('kelas', $user->mahasiswaProfile->kelas ?? '')"
                                        ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('kelas')" />
                                </div>

                                <div>
                                    <x-input-label for="no_hp" :value="__('Nomor WhatsApp / HP')" />
                                    <x-text-input id="no_hp" name="no_hp" type="text"
                                        class="mt-1 block w-full transition-colors duration-200"
                                        :value="old('no_hp', $user->mahasiswaProfile->no_hp ?? '')"
                                        ::disabled="!isEditing"
                                        ::class="!isEditing ? 'bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default' : 'bg-white border-gray-300'" />
                                    <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="dosen_wali_id" :value="__('Dosen Wali')" />

                                    <input type="text" x-show="!isEditing" disabled
                                        class="mt-1 block w-full bg-gray-50 text-gray-600 border-transparent shadow-none cursor-default rounded-md"
                                        value="{{ $user->mahasiswaProfile && $user->mahasiswaProfile->dosenWali ? $user->mahasiswaProfile->dosenWali->name : '-' }}">

                                    <select id="dosen_wali_id" name="dosen_wali_id" x-show="isEditing"
                                        style="display: none;"
                                        class="mt-1 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">
                                        <option value="">-- Pilih Dosen Wali --</option>
                                        @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->id }}"
                                            {{ (old('dosen_wali_id', $user->mahasiswaProfile->dosen_wali_id ?? '') == $dosen->id) ? 'selected' : '' }}>
                                            {{ $dosen->name }} ({{ $dosen->dosenProfile->kode_dosen ?? '-' }})
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('dosen_wali_id')" />
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>