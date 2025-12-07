<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Company;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // 1. STATISTIK UTAMA
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalMitra     = Company::count();
        $totalLowongan  = Vacancy::count();

        return view('welcome', compact(
            'totalMahasiswa',
            'totalMitra',
            'totalLowongan'
        ));
    }
}
