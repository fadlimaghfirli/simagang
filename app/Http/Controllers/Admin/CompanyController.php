<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Menampilkan daftar perusahaan
    public function index()
    {
        $companies = Company::latest()->get();
        // Perhatikan folder view-nya sesuai struktur folder yang kita bahas
        return view('admin.mitra.perusahaan.index', compact('companies'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('admin.mitra.perusahaan.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'address' => 'required|string',
        ]);

        Company::create($request->all());

        return redirect()->route('admin.companies.index')->with('success', 'Perusahaan berhasil ditambahkan');
    }

    // Hapus data
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('admin.companies.index')->with('success', 'Perusahaan berhasil dihapus');
    }
}
