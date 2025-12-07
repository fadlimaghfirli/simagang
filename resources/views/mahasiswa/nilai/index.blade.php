<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Transkrip Nilai Magang</h2>

            <div class="bg-white shadow-lg sm:rounded-xl overflow-hidden border border-gray-100">

                <div class="bg-indigo-600 p-8 text-center text-white">
                    <h3 class="text-lg font-medium text-indigo-100">Nilai Akhir</h3>
                    <div class="text-6xl font-extrabold mt-2">
                        {{ $application->final_score ? number_format($application->final_score, 2) : '-' }}
                    </div>
                    <div class="mt-2 text-sm font-semibold bg-indigo-800 inline-block px-3 py-1 rounded-full">
                        @if ($application->final_score >= 80)
                            GRADE A
                        @elseif($application->final_score >= 70)
                            GRADE B
                        @elseif($application->final_score >= 60)
                            GRADE C
                        @else
                            BELUM DINILAI
                        @endif
                    </div>
                </div>

                <div class="p-8 grid grid-cols-2 gap-8">
                    <div class="text-center p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="text-gray-500 text-sm uppercase font-bold tracking-wider mb-1">Nilai Bimbingan</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $application->score_bimbingan ?? 0 }}</div>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="text-gray-500 text-sm uppercase font-bold tracking-wider mb-1">Nilai Laporan</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $application->score_laporan ?? 0 }}</div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 border-t text-center">
                    <button onclick="window.print()" class="text-indigo-600 font-bold hover:underline">
                        Cetak Transkrip Nilai
                    </button>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
