<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index(Request $request) // Tambahkan Request di sini
    {
        // 1. Ambil kata kunci pencarian (jika ada)
        $search = $request->input('search');

        // 2. Query untuk Dosen (ditambah logika pencarian)
        $dosens = User::where('role', 'dosen')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5, ['*'], 'dosen_page');

        // 3. Query untuk Mahasiswa (logika sama)
        $mahasiswas = User::where('role', 'mahasiswa')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10, ['*'], 'mhs_page');

        // 4. Hitung total (Opsional: mau ikut difilter atau total asli)
        $total_user = User::count();

        return view('admin.users.index', compact('dosens', 'mahasiswas', 'total_user'));
    }

    // Menampilkan form tambah user
    public function create()
    {
        // Menampilkan file view create.blade.php
        return view('admin.users.create');
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,dosen,mahasiswa'], // Pastikan hanya role ini yang boleh
        ]);

        // 2. Simpan ke Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // <--- Ini kunci perbaikannya!
        ]);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // 5. Menyimpan perubahan data (Update)
    public function update(Request $request, User $user)
    {
        // Validasi (Password boleh kosong jika tidak ingin diganti)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Kecualikan email user ini sendiri
            'role' => 'required|in:admin,dosen,mahasiswa',
            'password' => 'nullable|min:8', // Nullable artinya boleh kosong
        ]);

        // Update data dasar
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika password diisi, maka update password juga
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    // 6. Menghapus data (Delete)
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // (Opsional) Mencegah admin menghapus dirinya sendiri
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus permanently.');
    }

    // 7. Import User dari Excel
    public function import(Request $request)
    {
        // 1. Validasi file harus Excel
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // 2. Proses Import
        try {
            Excel::import(new UsersImport, $request->file('file'));
            return redirect()->route('users.index')->with('success', 'User berhasil diimport secara masal!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }
}
