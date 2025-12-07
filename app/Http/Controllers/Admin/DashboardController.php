<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK UTAMA
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalDosen     = User::where('role', 'dosen')->count();
        $totalMitra     = Company::count();
        $totalLowongan  = Vacancy::count();

        // 2. STATISTIK PENTING (Action Needed)
        // Hitung berapa pendaftaran yang statusnya masih 'pending'
        $pendingPendaftaran = Application::where('status', 'pending')->count();

        // 3. DATA TERBARU (Untuk Tabel Preview)
        // Ambil 5 pendaftaran terakhir
        $recentApplications = Application::with(['user', 'vacancy.company'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalMitra',
            'totalLowongan',
            'pendingPendaftaran',
            'recentApplications'
        ));
    }
}
