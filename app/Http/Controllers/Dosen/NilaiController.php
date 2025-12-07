<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        // 1. Ambil mahasiswa bimbingan
        $applications = Application::with(['user', 'vacancy', 'laporan'])
            ->where('dosen_id', Auth::id())
            ->where('status', 'approved')
            ->get();

        return view('dosen.nilai.index', compact('applications'));
    }

    // Halaman Form Input Nilai
    public function edit($id)
    {
        $application = Application::with('laporan')->findOrFail($id);

        // 1. Cek apakah dosen yang login berhak
        if ($application->dosen_id != Auth::id()) {
            abort(403, 'Anda bukan pembimbing mahasiswa ini.');
        }

        // 2. CEK STATUS LAPORAN (KODE BARU)
        // Jika laporan tidak ada ATAU statusnya belum 'approved'
        if (!$application->laporan || $application->laporan->status != 'approved') {
            return redirect()->route('dosen.nilai.index')
                ->with('error', 'Tidak dapat menilai. Laporan Akhir mahasiswa belum disetujui.');
        }

        return view('dosen.nilai.edit', compact('application'));
    }

    // Proses Simpan Nilai
    public function update(Request $request, $id)
    {
        // 1. Cari manual
        $application = Application::findOrFail($id);

        // 2. Validasi Input
        $request->validate([
            'score_bimbingan' => 'required|integer|min:0|max:100',
            'score_laporan' => 'required|integer|min:0|max:100',
        ]);

        // 3. Hitung Rata-rata
        $finalScore = ($request->score_bimbingan + $request->score_laporan) / 2;

        // 4. Simpan
        $application->update([
            'score_bimbingan' => $request->score_bimbingan,
            'score_laporan' => $request->score_laporan,
            'final_score' => $finalScore
        ]);

        return redirect()->route('dosen.nilai.index')
            ->with('success', 'Nilai berhasil disimpan!');
    }
}
