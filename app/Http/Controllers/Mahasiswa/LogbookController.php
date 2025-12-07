<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Application; // Kita butuh ini untuk cek status magang
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException; // Untuk melempar error manual

class LogbookController extends Controller
{
    // Tampilkan Riwayat Logbook
    public function index()
    {
        // 1. Cek dulu apakah mahasiswa ini SUDAH DITERIMA magang?
        $isIntern = Application::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->exists();

        if (!$isIntern) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum diterima magang. Belum bisa mengisi logbook.');
        }

        // 2. Ambil data logbook user ini
        $logbooks = Logbook::where('user_id', Auth::id())
            ->latest('date')
            ->get();

        return view('mahasiswa.logbook.index', compact('logbooks'));
    }

    // Simpan Logbook Baru
    public function store(Request $request)
    {
        // 1. Cek apakah user sudah mengisi logbook di tanggal yang dipilih?
        // Kita cek manual SEBELUM validasi standar agar pesannya spesifik
        $sudahAda = Logbook::where('user_id', auth()->id())
            ->where('date', $request->date)
            ->exists();

        if ($sudahAda) {
            // Jika sudah ada, kembalikan dengan error di kolom 'date'
            throw ValidationException::withMessages([
                'date' => 'Anda sudah mengisi logbook untuk tanggal ini. Silakan edit data yang sudah ada.',
            ]);
        }

        // 2. Validasi Input
        $request->validate([
            // 'before_or_equal:today' = Hanya boleh hari ini atau masa lalu
            'date' => ['required', 'date', 'before_or_equal:today'],
            'activity' => 'required|string',
            'evidence' => 'nullable|image|max:2048',
        ], [
            // Pesan error kustom (Opsional)
            'date.before_or_equal' => 'Anda tidak dapat mengisi logbook untuk tanggal masa depan.',
        ]);

        // 3. Proses Simpan Data (Kode lama Anda)
        $data = [
            'user_id' => auth()->id(),
            'date' => $request->date,
            'activity' => $request->activity,
            'status' => 'pending', // Default status
        ];

        if ($request->hasFile('evidence')) {
            $path = $request->file('evidence')->store('evidence', 'public');
            $data['evidence'] = $path;
        }

        Logbook::create($data);

        return redirect()->route('mahasiswa.logbooks.index')->with('success', 'Logbook berhasil disimpan!');
    }

    // 1. TAMPILKAN FORM EDIT
    public function edit(Logbook $logbook)
    {
        // Keamanan: Pastikan punya sendiri & belum disetujui
        if ($logbook->user_id != Auth::id() || $logbook->status == 'approved') {
            abort(403, 'Logbook tidak bisa diedit.');
        }

        return view('mahasiswa.logbook.edit', compact('logbook'));
    }

    // 2. PROSES UPDATE
    public function update(Request $request, Logbook $logbook)
    {
        if ($logbook->user_id != Auth::id() || $logbook->status == 'approved') {
            abort(403);
        }

        $request->validate([
            'date' => 'required|date',
            'activity' => 'required|string|min:10',
            'evidence' => 'nullable|image|max:2048',
        ]);

        // Handle File Baru
        $evidencePath = $logbook->evidence; // Default pakai path lama
        if ($request->hasFile('evidence')) {
            // Hapus foto lama jika ada
            if ($logbook->evidence) {
                Storage::disk('public')->delete($logbook->evidence);
            }
            // Upload baru
            $evidencePath = $request->file('evidence')->store('evidence', 'public');
        }

        $logbook->update([
            'date' => $request->date,
            'activity' => $request->activity,
            'evidence' => $evidencePath,
            'status' => 'pending', // Reset jadi pending agar dicek ulang dosen
        ]);

        return redirect()->route('mahasiswa.logbooks.index')->with('success', 'Logbook berhasil diperbarui!');
    }

    // 3. PROSES HAPUS
    public function destroy(Logbook $logbook)
    {
        if ($logbook->user_id != Auth::id() || $logbook->status == 'approved') {
            abort(403, 'Logbook sudah disetujui, tidak bisa dihapus.');
        }

        // Hapus file foto
        if ($logbook->evidence) {
            Storage::disk('public')->delete($logbook->evidence);
        }

        $logbook->delete();

        return redirect()->route('mahasiswa.logbooks.index')->with('success', 'Logbook berhasil dihapus.');
    }
}
