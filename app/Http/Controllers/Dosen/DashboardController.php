<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Logbook;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dosenId = Auth::id();

        // 1. Ambil ID semua mahasiswa bimbingan dosen ini
        $studentIds = Application::where('dosen_id', $dosenId)
            ->where('status', 'approved')
            ->pluck('user_id');

        // 2. Hitung Statistik
        $totalMahasiswa = $studentIds->count();

        // Hitung Logbook yang statusnya 'pending' milik mahasiswa bimbingan
        $pendingLogbooks = Logbook::whereIn('user_id', $studentIds)
            ->where('status', 'pending')
            ->count();

        // Hitung Laporan yang statusnya 'pending' milik mahasiswa bimbingan
        $pendingLaporans = Laporan::whereIn('user_id', $studentIds)
            ->where('status', 'pending')
            ->count();

        // 3. Ambil Daftar Mahasiswa (Limit 5 terbaru untuk preview)
        $recentStudents = Application::with(['user', 'vacancy.company'])
            ->where('dosen_id', $dosenId)
            ->where('status', 'approved')
            ->latest()
            ->take(5)
            ->get();

        return view('dosen.dashboard', compact('totalMahasiswa', 'pendingLogbooks', 'pendingLaporans', 'recentStudents'));
    }
}
