<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index()
    {
        // 1. Cari tahu siapa saja mahasiswa bimbingan dosen ini
        $studentIds = Application::where('dosen_id', Auth::id())
            ->where('status', 'approved') // Hanya yang status magangnya aktif
            ->pluck('user_id'); // Ambil daftar ID user-nya saja

        // 2. Ambil logbook HANYA dari mahasiswa-mahasiswa tersebut
        $logbooks = Logbook::with('user')
            ->whereIn('user_id', $studentIds)
            ->latest('date') // Urutkan tanggal terbaru
            ->get();

        return view('dosen.logbook.index', compact('logbooks'));
    }

    // Halaman Detail untuk Review
    public function show(Logbook $logbook)
    {
        // Pastikan dosen ini berhak melihat logbook ini (Keamanan)
        // Cek apakah mahasiswa pemilik logbook ini adalah bimbingan dosen ini
        $isMyStudent = Application::where('user_id', $logbook->user_id)
            ->where('dosen_id', Auth::id())
            ->exists();

        if (!$isMyStudent) {
            abort(403, 'Anda tidak memiliki akses ke logbook mahasiswa ini.');
        }

        return view('dosen.logbook.show', compact('logbook'));
    }

    // Simpan Validasi (Approve/Reject)
    public function update(Request $request, Logbook $logbook)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'notes' => 'nullable|string'
        ]);

        $logbook->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        return redirect()->route('dosen.logbooks.index')
            ->with('success', 'Status logbook berhasil diperbarui.');
    }
}
