<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    // Menampilkan daftar lowongan yang AKTIF saja
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian
        $search = $request->input('search');

        $vacancies = Vacancy::with('company') // Load relasi company agar efisien
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    // 1. Cari berdasarkan Nama Posisi
                    $q->where('position', 'like', "%{$search}%")
                        // 2. Cari berdasarkan Deskripsi
                        ->orWhere('description', 'like', "%{$search}%")
                        // 3. Cari berdasarkan Nama Perusahaan (Relasi)
                        ->orWhereHas('company', function ($subQ) use ($search) {
                            $subQ->where('name', 'like', "%{$search}%");
                        });
                });
            })
            // Hanya tampilkan lowongan yang kuotanya masih ada (Opsional)
            // ->where('quota', '>', 0) 
            ->latest() // Urutkan dari yang terbaru
            ->paginate(9); // Tampilkan 9 lowongan per halaman

        return view('mahasiswa.lowongan.index', compact('vacancies'));
    }

    // Menampilkan detail satu lowongan
    public function show(Vacancy $vacancy)
    {
        // Cek apakah lowongan aktif. Jika tidak, tampilkan 404
        if (!$vacancy->is_active) {
            abort(404);
        }

        return view('mahasiswa.lowongan.show', compact('vacancy'));
    }
}
