<x-app-layout>
    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Jurnal Kegiatan</h2>
                    <p class="text-gray-500 mt-1">Catat progres harian dan aktivitas magang Anda.</p>
                </div>

                <div class="flex gap-3">
                    <div class="px-4 py-2 bg-white rounded-lg shadow-sm border border-gray-100 text-center">
                        <span class="block text-xs text-gray-400 font-semibold uppercase">Total Log</span>
                        <span class="font-bold text-indigo-600 text-lg">{{ $logbooks->count() }}</span>
                    </div>
                    <div class="px-4 py-2 bg-white rounded-lg shadow-sm border border-gray-100 text-center">
                        <span class="block text-xs text-gray-400 font-semibold uppercase">Disetujui</span>
                        <span
                            class="font-bold text-emerald-600 text-lg">{{ $logbooks->where('status', 'approved')->count() }}</span>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-emerald-50 p-4 text-emerald-700 border border-emerald-200 flex items-center gap-3"
                    role="alert">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1">
                    <div
                        class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6 sticky top-8 border border-gray-100">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                            <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Tulis Log Baru</h3>
                        </div>

                        <form action="{{ route('mahasiswa.logbooks.store') }}" method="POST"
                            enctype="multipart/form-data" class="space-y-5">
                            @csrf

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal</label>
                                <input type="date" name="date"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all"
                                    value="{{ old('date', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" required>
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Aktivitas</label>
                                <textarea name="activity" rows="4"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all text-sm leading-relaxed"
                                    placeholder="Contoh: Mengembangkan fitur login, Meeting dengan supervisor..." required>{{ old('activity') }}</textarea>
                                <x-input-error :messages="$errors->get('activity')" class="mt-2" />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Dokumentasi</label>

                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors relative overflow-hidden">

                                        <div class="flex flex-col items-center justify-center pt-5 pb-6"
                                            id="placeholder-view">
                                            <svg class="w-8 h-8 mb-2 text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="text-xs text-gray-500"><span class="font-semibold">Klik untuk
                                                    upload</span> gambar</p>
                                            <p class="text-xs text-gray-400 mt-1">PNG, JPG (Max. 2MB)</p>
                                        </div>

                                        <div id="file-info"
                                            class="hidden absolute inset-0 flex-col items-center justify-center bg-indigo-50 w-full h-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 mb-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-sm font-medium text-indigo-700 truncate px-4"
                                                id="filename-display">File terpilih</p>
                                        </div>

                                        <input id="dropzone-file" name="evidence" type="file" class="hidden"
                                            accept="image/*" onchange="showFileName(this)" />
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('evidence')" class="mt-2" />
                            </div>

                            <button type="submit"
                                class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5">
                                Simpan Logbook
                            </button>
                        </form>

                        <script>
                            function showFileName(input) {
                                const placeholder = document.getElementById('placeholder-view');
                                const fileInfo = document.getElementById('file-info');
                                const filenameDisplay = document.getElementById('filename-display');

                                if (input.files && input.files[0]) {
                                    placeholder.classList.add('hidden');
                                    fileInfo.classList.remove('hidden');
                                    fileInfo.classList.add('flex');
                                    filenameDisplay.textContent = input.files[0].name;
                                }
                            }
                        </script>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <span>Riwayat Aktivitas</span>
                        <div class="h-px bg-gray-200 flex-grow"></div>
                    </h3>

                    @if ($logbooks->isEmpty())
                        <div
                            class="bg-white rounded-2xl shadow-sm border border-dashed border-gray-300 p-12 text-center">
                            <div
                                class="mx-auto h-16 w-16 bg-indigo-50 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Belum ada aktivitas</h3>
                            <p class="mt-1 text-gray-500">Mulai hari pertamamu dengan mencatat kegiatan di formulir
                                samping.</p>
                        </div>
                    @else
                        <div
                            class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-300 before:to-transparent">

                            @foreach ($logbooks as $log)
                                <div
                                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">

                                    <div
                                        class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 absolute left-0 md:left-1/2 -translate-x-1">
                                        @if ($log->status == 'approved')
                                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                        @elseif($log->status == 'rejected')
                                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        @else
                                            <div class="w-3 h-3 bg-amber-400 rounded-full animate-pulse"></div>
                                        @endif
                                    </div>

                                    <div
                                        class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow ml-12 md:ml-0">

                                        <div class="flex justify-between items-start mb-3">
                                            <div>
                                                <time
                                                    class="font-bold text-gray-900 block text-lg">{{ \Carbon\Carbon::parse($log->date)->format('d F Y') }}</time>
                                                <span
                                                    class="text-xs font-medium text-gray-500">{{ \Carbon\Carbon::parse($log->date)->format('l') }}</span>
                                            </div>

                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $log->status == 'approved'
                                                    ? 'bg-emerald-100 text-emerald-800'
                                                    : ($log->status == 'rejected'
                                                        ? 'bg-red-100 text-red-800'
                                                        : 'bg-amber-100 text-amber-800') }}">
                                                {{ ucfirst($log->status) }}
                                            </span>
                                        </div>

                                        <div class="text-gray-600 text-sm leading-relaxed mb-4 whitespace-pre-line">
                                            {{ $log->activity }}
                                        </div>

                                        @if ($log->evidence)
                                            <div class="mb-4 relative group/img overflow-hidden rounded-lg">
                                                <img src="{{ asset('storage/' . $log->evidence) }}" alt="Bukti"
                                                    class="w-full h-40 object-cover transform transition-transform duration-500 group-hover/img:scale-105">
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover/img:bg-opacity-10 transition-opacity">
                                                </div>
                                            </div>
                                        @endif

                                        @if ($log->notes)
                                            <div class="bg-red-50 border-l-4 border-red-400 p-3 rounded-r mb-4">
                                                <div class="flex">
                                                    <div class="flex-shrink-0">
                                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-xs text-red-700">
                                                            <span class="font-bold">Catatan Pembimbing:</span><br>
                                                            {{ $log->notes }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($log->status != 'approved')
                                            <div
                                                class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100">
                                                <a href="{{ route('mahasiswa.logbooks.edit', $log->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 text-xs font-semibold flex items-center gap-1 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form action="{{ route('mahasiswa.logbooks.destroy', $log->id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus logbook ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-700 text-xs font-semibold flex items-center gap-1 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
