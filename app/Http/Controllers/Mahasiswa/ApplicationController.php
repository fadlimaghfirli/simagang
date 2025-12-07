<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Menampilkan Form Pendaftaran
    public function create(Vacancy $vacancy)
    {
        // --- [MODIFIKASI MULAI] ---
        // 1. Cek Global: Apakah mahasiswa sudah punya tempat magang (Approved/Finished)?
        $hasActiveInternship = Application::where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'finished'])
            ->exists();

        if ($hasActiveInternship) {
            return redirect()->route('mahasiswa.lowongan.index')
                ->with('error', 'Anda sudah diterima dalam program magang atau telah menyelesaikannya. Tidak dapat melamar lagi.');
        }
        // --- [MODIFIKASI SELESAI] ---

        // 2. Cek Spesifik: Apakah mahasiswa sudah pernah melamar di lowongan INI?
        $existingApplication = Application::where('user_id', Auth::id())
            ->where('vacancy_id', $vacancy->id)
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'Anda sudah melamar di posisi ini sebelumnya.');
        }

        return view('mahasiswa.applications.create', compact('vacancy'));
    }

    // Proses Simpan Data & Upload File
    public function store(Request $request, Vacancy $vacancy)
    {
        // --- [MODIFIKASI MULAI] ---
        // 1. Validasi Keamanan (Double Check): Cek lagi status magang user sebelum simpan
        $hasActiveInternship = Application::where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'finished'])
            ->exists();

        if ($hasActiveInternship) {
            return redirect()->route('mahasiswa.lowongan.index')
                ->with('error', 'Gagal: Anda sudah memiliki tempat magang.');
        }

        // 2. Cek Duplikasi di Lowongan ini (Double Check)
        $alreadyApplied = Application::where('user_id', Auth::id())
            ->where('vacancy_id', $vacancy->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('error', 'Anda sudah mengirim lamaran untuk posisi ini.');
        }
        // --- [MODIFIKASI SELESAI] ---

        // 3. Validasi Input File
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048', // Wajib PDF, maks 2MB
            'transcript' => 'nullable|mimes:pdf|max:2048', // Opsional
        ]);

        // 4. Proses Upload File
        $cvPath = $request->file('cv')->store('applications', 'public');

        $transcriptPath = null;
        if ($request->hasFile('transcript')) {
            $transcriptPath = $request->file('transcript')->store('applications', 'public');
        }

        // 5. Simpan ke Database
        Application::create([
            'user_id' => Auth::id(),
            'vacancy_id' => $vacancy->id,
            'apply_date' => now(),
            'status' => 'pending', // Status awal selalu pending
            'cv_path' => $cvPath,
            'transcript_path' => $transcriptPath,
        ]);

        // 6. Redirect
        return redirect()->route('mahasiswa.lowongan.index')
            ->with('success', 'Lamaran berhasil dikirim! Tunggu verifikasi admin.');
    }
}
