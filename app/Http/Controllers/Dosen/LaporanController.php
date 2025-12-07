<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Ambil ID mahasiswa yang dibimbing oleh dosen ini
        $studentIds = Application::where('dosen_id', Auth::id())
            ->where('status', 'approved')
            ->pluck('user_id');

        // 2. Ambil laporan milik mahasiswa-mahasiswa tersebut
        $laporans = Laporan::with('user')
            ->whereIn('user_id', $studentIds)
            ->latest()
            ->get();

        return view('dosen.laporan.index', compact('laporans'));
    }

    public function show(Laporan $laporan)
    {
        // Keamanan: Pastikan ini laporan milik mahasiswa bimbingannya
        $isMyStudent = Application::where('user_id', $laporan->user_id)
            ->where('dosen_id', Auth::id())
            ->exists();

        if (!$isMyStudent) {
            abort(403, 'Akses ditolak.');
        }

        return view('dosen.laporan.show', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:approved,revision',
            'notes' => 'nullable|string'
        ]);

        $laporan->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        return redirect()->route('dosen.laporan.index')
            ->with('success', 'Status laporan berhasil diperbarui.');
    }
}
