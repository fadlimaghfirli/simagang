<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

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

    // Menampilkan Detail User (Show)
    public function show(User $user)
    {
        if ($user->role === 'dosen') {
            return view('admin.users.show_dosen', compact('user'));
        }

        // Nanti kita tambahkan untuk mahasiswa di sini
        // elseif ($user->role === 'mahasiswa') { ... }

        return redirect()->back();
    }

    // 1. Form Khusus Tambah Dosen
    public function createDosen()
    {
        return view('admin.users.create_dosen');
    }

    // 2. Form Khusus Tambah Mahasiswa
    public function createMahasiswa()
    {
        // Kita butuh data dosen untuk dropdown "Dosen Wali"
        $dosens = User::where('role', 'dosen')->get();
        return view('admin.users.create_mahasiswa', compact('dosens'));
    }

    // --- Update Method STORE ---
    public function store(Request $request)
    {
        // 1. Validasi Data Akun Utama
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,dosen,mahasiswa'],
        ]);

        // 2. Validasi Data Profil (Kondisional)
        if ($request->role === 'dosen') {
            $request->validate([
                'nip' => ['required', 'string', 'unique:dosen_profiles,nip'], // Cek unik di tabel profil
                'nidn' => ['nullable', 'string', 'unique:dosen_profiles,nidn'],
                'kode_dosen' => ['nullable', 'string', 'max:5'],
                'no_hp' => ['nullable', 'string', 'max:15'],
            ]);
        } elseif ($request->role === 'mahasiswa') {
            $request->validate([
                'nim' => ['required', 'string', 'unique:mahasiswa_profiles,nim'],
                'angkatan' => ['required', 'numeric', 'digits:4'],
                'kelas' => ['nullable', 'string', 'max:10'],
                'dosen_wali_id' => ['nullable', 'exists:users,id'], // Pastikan ID dosen ada di tabel users
            ]);
        }

        // 3. Simpan dengan Transaction (Agar data konsisten: User & Profile tersimpan bareng)
        DB::transaction(function () use ($request) {

            // A. Buat User Login
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // B. Buat Profile Sesuai Role
            if ($request->role === 'dosen') {
                $user->dosenProfile()->create([
                    'nip' => $request->nip,
                    'nidn' => $request->nidn,
                    'kode_dosen' => $request->kode_dosen,
                    'no_hp' => $request->no_hp,
                ]);
            } elseif ($request->role === 'mahasiswa') {
                $user->mahasiswaProfile()->create([
                    'nim' => $request->nim,
                    'angkatan' => $request->angkatan,
                    'kelas' => $request->kelas,
                    'no_hp' => $request->no_hp, // Ambil no_hp dari input jika ada (tambahkan di view nanti)
                    'dosen_wali_id' => $request->dosen_wali_id,
                ]);
            }
            // Admin tidak perlu profil khusus
        });

        // Redirect sesuai role yang baru dibuat
        $redirectRoute = 'admin.users.index';
        if ($request->role === 'dosen') $redirectRoute = 'admin.users.dosen';
        if ($request->role === 'mahasiswa') $redirectRoute = 'admin.users.mahasiswa';

        return redirect()->route($redirectRoute)->with('success', 'User berhasil ditambahkan beserta profilnya!');
    }

    // 1. Edit Khusus Dosen
    public function editDosen(User $user)
    {
        // Pastikan user ini benar-benar dosen
        if ($user->role !== 'dosen') return redirect()->back();

        return view('admin.users.edit_dosen', compact('user'));
    }

    // 2. Edit Khusus Mahasiswa
    public function editMahasiswa(User $user)
    {
        if ($user->role !== 'mahasiswa') return redirect()->back();

        $dosens = User::where('role', 'dosen')->get();
        return view('admin.users.edit_mahasiswa', compact('user', 'dosens'));
    }

    // 3. Update Data (Menangani User + Profil)
    public function update(Request $request, User $user)
    {
        // A. Validasi Data Dasar
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        // B. Update Data User Login
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        // Kita tidak update 'role' di sini karena edit user biasanya role-nya tetap.
        // Jika ingin ubah role, sebaiknya hapus user dan buat baru agar data profil bersih.

        $user->update($userData);

        // C. Update Data Profil Sesuai Role
        if ($user->role === 'dosen') {
            $request->validate([
                'nip' => 'required|string|unique:dosen_profiles,nip,' . optional($user->dosenProfile)->id,
                'nidn' => 'nullable|string|unique:dosen_profiles,nidn,' . optional($user->dosenProfile)->id,
                'kode_dosen' => 'nullable|string|max:5',
                'no_hp' => 'nullable|string|max:15',
            ]);

            // Gunakan updateOrCreate untuk menangani jika profil sebelumnya belum ada
            $user->dosenProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nip' => $request->nip,
                    'nidn' => $request->nidn,
                    'kode_dosen' => $request->kode_dosen,
                    'no_hp' => $request->no_hp,
                ]
            );

            return redirect()->route('admin.users.dosen')->with('success', 'Data Dosen berhasil diperbarui!');
        } elseif ($user->role === 'mahasiswa') {
            $request->validate([
                'nim' => 'required|string|unique:mahasiswa_profiles,nim,' . optional($user->mahasiswaProfile)->id,
                'angkatan' => 'required|numeric',
                'kelas' => 'nullable|string',
                'dosen_wali_id' => 'nullable|exists:users,id',
            ]);

            $user->mahasiswaProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nim' => $request->nim,
                    'angkatan' => $request->angkatan,
                    'kelas' => $request->kelas,
                    'no_hp' => $request->no_hp,
                    'dosen_wali_id' => $request->dosen_wali_id,
                ]
            );

            return redirect()->route('admin.users.mahasiswa')->with('success', 'Data Mahasiswa berhasil diperbarui!');
        }

        return redirect()->route('admin.users.index')->with('success', 'Data User berhasil diperbarui!');
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

    // 1. Fungsi Khusus Menampilkan Halaman Dosen
    public function indexDosen(Request $request)
    {
        $search = $request->input('search');

        $dosens = User::where('role', 'dosen')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10); // Kita set 10 per halaman

        // Kita akan buat view ini di langkah selanjutnya
        return view('admin.users.dosen_index', compact('dosens'));
    }

    // 2. Fungsi Khusus Menampilkan Halaman Mahasiswa
    public function indexMahasiswa(Request $request)
    {
        $search = $request->input('search');

        $mahasiswas = User::where('role', 'mahasiswa')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // Kita akan buat view ini di langkah selanjutnya
        return view('admin.users.mahasiswa_index', compact('mahasiswas'));
    }
}
