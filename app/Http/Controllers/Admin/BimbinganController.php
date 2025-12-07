<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;

class BimbinganController extends Controller
{
    public function index()
    {
        // Ambil lamaran yang statusnya 'approved' (Diterima)
        $applications = Application::with(['user', 'vacancy', 'dosen'])
            ->where('status', 'approved')
            ->latest()
            ->get();

        // Ambil daftar semua user yang role-nya 'dosen' untuk dropdown
        $dosens = User::where('role', 'dosen')->get();

        return view('admin.bimbingan.index', compact('applications', 'dosens'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'dosen_id' => 'required|exists:users,id'
        ]);

        // 1. Cari data manual berdasarkan ID (Paling Aman)
        $application = Application::findOrFail($id);

        // 2. Lakukan Update
        $application->update([
            'dosen_id' => $request->dosen_id
        ]);

        return redirect()->back()->with('success', 'Dosen pembimbing berhasil ditetapkan!');
    }
}
