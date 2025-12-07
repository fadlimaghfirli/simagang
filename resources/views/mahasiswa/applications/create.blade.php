<x-app-layout>
    <div class="py-12 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('mahasiswa.lowongan.show', $vacancy->id) }}"
                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 mb-6 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Batalkan & Kembali ke Detail Lowongan
            </a>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">

                <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-indigo-400 opacity-20 rounded-full blur-2xl">
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-bold relative z-10">Formulir Lamaran Magang</h2>
                    <p class="text-indigo-100 mt-2 relative z-10 text-lg">
                        Langkah terakhir untuk bergabung sebagai <span
                            class="font-semibold text-white">{{ $vacancy->position }}</span>
                    </p>
                    <div
                        class="flex items-center gap-2 mt-4 text-sm font-medium bg-white/20 w-fit px-3 py-1 rounded-full backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        {{ $vacancy->company->name }}
                    </div>
                </div>

                <div class="p-8">

                    @if ($errors->any())
                        <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada lampiran Anda
                                    </h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('mahasiswa.applications.store', $vacancy->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex justify-between">
                                <span>Curriculum Vitae (CV) <span class="text-red-500">*</span></span>
                                {{-- <span
                                    class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-0.5 rounded">Wajib</span> --}}
                            </label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 hover:border-indigo-400 transition-all cursor-pointer relative group"
                                id="cv-dropzone">
                                <div class="space-y-1 text-center" id="cv-placeholder">
                                    <div
                                        class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition-colors">
                                        <svg class="h-12 w-12" stroke="currentColor" fill="none" viewBox="0 0 48 48"
                                            aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="cv"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload file CV</span>
                                            <input id="cv" name="cv" type="file" class="sr-only"
                                                accept=".pdf" required
                                                onchange="updateFileName(this, 'cv-filename', 'cv-placeholder')">
                                        </label>
                                        <p class="pl-1">atau drag & drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF hingga 2MB</p>
                                </div>

                                <div id="cv-filename" class="hidden flex-col items-center justify-center w-full">
                                    <svg class="w-10 h-10 text-red-500 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p
                                        class="text-sm font-semibold text-gray-900 truncate max-w-xs text-center file-name-text">
                                    </p>
                                    <p class="text-xs text-green-600 font-medium mt-1">Siap diunggah</p>
                                    <button type="button" onclick="resetFile('cv', 'cv-filename', 'cv-placeholder')"
                                        class="mt-2 text-xs text-gray-400 hover:text-red-500 underline">Ganti
                                        File</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex justify-between">
                                <span>Transkrip Nilai <span class="text-red-500">*</span></span>
                                {{-- <span
                                    class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-0.5 rounded border border-gray-200">Opsional</span> --}}
                            </label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 hover:border-indigo-400 transition-all cursor-pointer relative group"
                                id="trans-dropzone">
                                <div class="space-y-1 text-center" id="trans-placeholder">
                                    <div
                                        class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition-colors">
                                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="transcript"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload Transkrip</span>
                                            <input id="transcript" name="transcript" type="file" class="sr-only"
                                                accept=".pdf"
                                                onchange="updateFileName(this, 'trans-filename', 'trans-placeholder')"
                                                required>
                                        </label>
                                        <p class="pl-1">atau drag & drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF hingga 2MB (Jika diminta)</p>
                                </div>

                                <div id="trans-filename" class="hidden flex-col items-center justify-center w-full">
                                    <svg class="w-10 h-10 text-red-500 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p
                                        class="text-sm font-semibold text-gray-900 truncate max-w-xs text-center file-name-text">
                                    </p>
                                    <p class="text-xs text-green-600 font-medium mt-1">Siap diunggah</p>
                                    <button type="button"
                                        onclick="resetFile('transcript', 'trans-filename', 'trans-placeholder')"
                                        class="mt-2 text-xs text-gray-400 hover:text-red-500 underline">Ganti
                                        File</button>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-6 flex items-center justify-end gap-4">
                            <button type="submit"
                                class="inline-flex justify-center items-center py-3 px-8 border border-transparent shadow-lg shadow-indigo-200 text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Lamaran
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <p class="text-center text-gray-400 text-xs mt-8">
                Pastikan data yang Anda kirimkan sudah benar. Lamaran tidak dapat diedit setelah dikirim.
            </p>

        </div>
    </div>

    <script>
        function updateFileName(input, infoId, placeholderId) {
            const infoDiv = document.getElementById(infoId);
            const placeholderDiv = document.getElementById(placeholderId);
            const nameText = infoDiv.querySelector('.file-name-text');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Cek ukuran file (2MB limit di client side untuk UX)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    input.value = ''; // Reset
                    return;
                }

                nameText.textContent = file.name;
                placeholderDiv.classList.add('hidden');
                infoDiv.classList.remove('hidden');
                infoDiv.classList.add('flex');
            }
        }

        function resetFile(inputId, infoId, placeholderId) {
            const input = document.getElementById(inputId);
            const infoDiv = document.getElementById(infoId);
            const placeholderDiv = document.getElementById(placeholderId);

            input.value = ''; // Reset value input
            infoDiv.classList.add('hidden');
            infoDiv.classList.remove('flex');
            placeholderDiv.classList.remove('hidden');
        }
    </script>
</x-app-layout>
