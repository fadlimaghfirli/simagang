<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::where('user_id', Auth::id())->first();
        return view('mahasiswa.laporan.index', compact('laporan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_laporan' => 'required|mimes:pdf|max:5120',
        ]);

        $path = $request->file('file_laporan')->store('laporan_akhir', 'public');

        Laporan::create([
            'user_id' => Auth::id(),
            'file_path' => $path,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Laporan Akhir berhasil diunggah!');
    }

    // FUNGSI UPDATE (Ganti File)
    public function update(Request $request, Laporan $laporan)
    {
        // Keamanan: Jika sudah disetujui, tidak boleh ubah lagi
        if ($laporan->status == 'approved') {
            return redirect()->back()->with('error', 'Laporan sudah disetujui, tidak bisa diubah.');
        }

        $request->validate([
            'file_laporan' => 'required|mimes:pdf|max:5120',
        ]);

        // 1. Hapus file lama dari penyimpanan
        if ($laporan->file_path) {
            Storage::disk('public')->delete($laporan->file_path);
        }

        // 2. Upload file baru
        $path = $request->file('file_laporan')->store('laporan_akhir', 'public');

        // 3. Update database
        $laporan->update([
            'file_path' => $path,
            'status' => 'pending', // Reset jadi pending (agar dosen cek ulang)
            // Kita tidak menghapus 'notes' agar mahasiswa ingat revisi sebelumnya apa, 
            // tapi jika ingin dihapus silakan uncomment baris bawah:
            // 'notes' => null 
        ]);

        return redirect()->back()->with('success', 'File laporan berhasil diperbarui!');
    }

    // FUNGSI DESTROY (Hapus Laporan) - BARU
    public function destroy(Laporan $laporan)
    {
        // Keamanan: Jika sudah disetujui, tidak boleh hapus
        if ($laporan->status == 'approved') {
            return redirect()->back()->with('error', 'Laporan sudah disetujui, tidak bisa dihapus.');
        }

        // 1. Hapus file fisik
        if ($laporan->file_path) {
            Storage::disk('public')->delete($laporan->file_path);
        }

        // 2. Hapus data di database
        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus. Silakan unggah baru.');
    }
}
