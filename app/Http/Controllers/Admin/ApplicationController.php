<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    // 1. Menampilkan Daftar Semua Lamaran
    public function index()
    {
        // Ambil data lamaran + data user + data lowongan + data perusahaan
        $applications = Application::with(['user', 'vacancy.company'])
            ->latest()
            ->get();

        return view('admin.pendaftaran.index', compact('applications'));
    }

    // 2. Menampilkan Detail Lamaran (Untuk Review CV)
    public function show(Application $application)
    {
        return view('admin.pendaftaran.show', compact('application'));
    }

    // 3. Update Status (Setujui / Tolak)
    public function update(Request $request, $id)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Gunakan DB Transaction agar data aman (konsisten antara kuota & status)
        return DB::transaction(function () use ($request, $id) {

            $application = Application::with('vacancy')->findOrFail($id);
            $newStatus = $request->status;
            $oldStatus = $application->status;
            $vacancy = $application->vacancy;

            // --- LOGIKA PENGURANGAN KUOTA ---

            // KASUS 1: Admin ingin Meng-ACC (Pending/Rejected -> Approved)
            if ($newStatus == 'approved' && $oldStatus != 'approved') {

                // Cek apakah kuota masih tersedia?
                if ($vacancy->quota <= 0) {
                    // Jika kuota habis, lempar error balik
                    return redirect()->back()->with('error', 'Gagal! Kuota untuk posisi ini sudah habis (0).');
                }

                // Kurangi Kuota
                $vacancy->decrement('quota');
            }

            // KASUS 2: Admin membatalkan ACC (Approved -> Rejected/Pending)
            // (Opsional: Kembalikan kuota jika admin salah klik)
            elseif ($oldStatus == 'approved' && $newStatus != 'approved') {
                $vacancy->increment('quota');
            }

            // --- SIMPAN PERUBAHAN ---

            $application->status = $newStatus;
            $application->save();

            return redirect()->back()->with('success', 'Status lamaran berhasil diperbarui & kuota disesuaikan.');
        });
    }
}
