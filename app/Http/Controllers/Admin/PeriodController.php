<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        // Urutkan dari yang terbaru
        $periods = Period::latest()->get();
        return view('admin.periods.index', compact('periods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Jika belum ada data sama sekali, set yang pertama ini jadi aktif
        $isActive = Period::count() === 0;

        Period::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $isActive
        ]);

        return redirect()->route('admin.periods.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    public function activate(Period $period)
    {
        // 1. Nonaktifkan semua periode lain
        Period::query()->update(['is_active' => false]);

        // 2. Aktifkan periode yang dipilih
        $period->update(['is_active' => true]);

        return redirect()->route('admin.periods.index')->with('success', "Periode {$period->name} berhasil diaktifkan.");
    }

    public function destroy(Period $period)
    {
        if ($period->is_active) {
            return back()->with('error', 'Tidak dapat menghapus periode yang sedang aktif.');
        }

        $period->delete();
        return back()->with('success', 'Periode berhasil dihapus.');
    }
}
