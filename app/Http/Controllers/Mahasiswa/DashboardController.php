<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil lamaran terakhir mahasiswa ini
        // Kita pakai 'with' agar bisa menampilkan nama perusahaan nanti
        $application = Application::with('vacancy.company')
            ->where('user_id', Auth::id())
            ->latest()
            ->first();

        return view('mahasiswa.dashboard', compact('application'));
    }
}
