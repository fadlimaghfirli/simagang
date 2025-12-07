<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Ambil data lamaran dimana:
        // 1. Dosennya adalah User yang sedang login
        // 2. Statusnya 'approved' (Artinya sedang magang aktif)
        $students = Application::with(['user', 'vacancy.company'])
            ->where('dosen_id', Auth::id())
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('dosen.mahasiswa.index', compact('students'));
    }
}
