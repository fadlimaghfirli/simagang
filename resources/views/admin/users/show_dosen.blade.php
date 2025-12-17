<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Dosen') }}
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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">

                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Pengguna</h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div
                        class="md:col-span-1 flex flex-col items-center text-center p-4 border rounded-xl bg-indigo-50 border-indigo-100">
                        <div
                            class="h-24 w-24 rounded-full bg-white flex items-center justify-center text-indigo-600 font-bold text-3xl shadow-sm mb-4 border-2 border-indigo-200">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <h4 class="font-bold text-lg text-gray-900">{{ $user->name }}</h4>
                        <p class="text-sm text-gray-500 mb-2">{{ $user->email }}</p>
                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-700 uppercase tracking-wide">
                            {{ $user->role }}
                        </span>

                        <div class="mt-6 w-full">
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="block w-full py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium transition-colors">
                                Edit Profil
                            </a>
                        </div>
                    </div>

                    <div class="md:col-span-2 space-y-6">
                        <h4 class="font-medium text-gray-900 border-b pb-2">Data Akademik</h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">NIP</label>
                                <p class="text-gray-900 font-medium">{{ $user->dosenProfile->nip ?? '-' }}</p>
                            </div>

                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">NIDN</label>
                                <p class="text-gray-900 font-medium">{{ $user->dosenProfile->nidn ?? '-' }}</p>
                            </div>

                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Kode Dosen</label>
                                <p class="text-gray-900 font-medium">{{ $user->dosenProfile->kode_dosen ?? '-' }}</p>
                            </div>

                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">No. Handphone</label>
                                <p class="text-gray-900 font-medium">{{ $user->dosenProfile->no_hp ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="pt-4">
                            <h4 class="font-medium text-gray-900 border-b pb-2">Status Akun</h4>
                            <div class="mt-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Akun Aktif & Terverifikasi</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Dibuat pada:
                                {{ $user->created_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>