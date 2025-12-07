<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Models\Company;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        // Ambil data lowongan beserta nama perusahaannya (with company)
        $vacancies = Vacancy::with('company')->latest()->get();
        return view('admin.mitra.lowongan.index', compact('vacancies'));
    }

    public function create()
    {
        // Kita butuh daftar perusahaan untuk Dropdown (Select Option)
        $companies = Company::all();
        return view('admin.mitra.lowongan.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'position' => 'required|string',
            'quota' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);

        Vacancy::create($request->all());

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil dibuat!');
    }

    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan dihapus.');
    }
}
