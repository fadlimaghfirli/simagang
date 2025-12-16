<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    // Ini akan otomatis membuat route untuk index, create, store, edit, update, destroy
    // Nama routenya otomatis jadi: users.index, users.create, users.store, dst.
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});

// Rute untuk ADMIN (Hanya boleh diakses role:admin)
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Manajemen User (Resource Controller)
    // KITA TAMBAHKAN INI (Route Custom sebelum Resource)
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/dosen', [\App\Http\Controllers\Admin\UserController::class, 'indexDosen'])->name('dosen');
        Route::get('/mahasiswa', [\App\Http\Controllers\Admin\UserController::class, 'indexMahasiswa'])->name('mahasiswa');
    });

    // Manajemen User (Resource Controller)
    // Ini otomatis membuat rute index, create, store, edit, update, destroy
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    // Manajemen Perusahaan (Mitra)
    Route::resource('companies', \App\Http\Controllers\Admin\CompanyController::class);

    // Manajemen Lowongan
    Route::resource('vacancies', \App\Http\Controllers\Admin\VacancyController::class);

    // Monitoring Pendaftaran
    Route::resource('applications', \App\Http\Controllers\Admin\ApplicationController::class)
        ->only(['index', 'show', 'update']); // Kita hanya butuh 3 fungsi ini

    // Manajemen Bimbingan (Plotting)
    Route::resource('bimbingan', \App\Http\Controllers\Admin\BimbinganController::class)
        ->only(['index', 'update']);
});
// Import Users dari Excel
Route::post('users/import', [\App\Http\Controllers\Admin\UserController::class, 'import'])->name('users.import');

// Rute untuk DOSEN (Hanya boleh diakses role:dosen)
Route::middleware(['auth', 'verified', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dosen.dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');

    // Monitoring Logbook
    Route::resource('logbooks', \App\Http\Controllers\Dosen\LogbookController::class)
        ->only(['index', 'show', 'update']);

    // Validasi Laporan Akhir
    Route::resource('laporan', \App\Http\Controllers\Dosen\LaporanController::class)
        ->only(['index', 'show', 'update']);

    // Penilaian
    Route::resource('nilai', \App\Http\Controllers\Dosen\NilaiController::class)
        ->only(['index', 'edit', 'update']);

    // Daftar Mahasiswa Bimbingan
    Route::get('/mahasiswa-bimbingan', [\App\Http\Controllers\Dosen\MahasiswaController::class, 'index'])
        ->name('mahasiswa.index');
});

// Rute untuk MAHASISWA (Hanya boleh diakses role:mahasiswa)
Route::middleware(['auth', 'verified', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Info Lowongan (Hanya Index dan Show)
    Route::get('/lowongan', [\App\Http\Controllers\Mahasiswa\VacancyController::class, 'index'])->name('lowongan.index');
    Route::get('/lowongan/{vacancy}', [\App\Http\Controllers\Mahasiswa\VacancyController::class, 'show'])->name('lowongan.show');

    // Form Apply (Butuh ID lowongan)
    Route::get('/lowongan/{vacancy}/apply', [\App\Http\Controllers\Mahasiswa\ApplicationController::class, 'create'])->name('applications.create');

    // Proses Simpan Apply
    Route::post('/lowongan/{vacancy}/apply', [\App\Http\Controllers\Mahasiswa\ApplicationController::class, 'store'])->name('applications.store');

    // Logbook Kegiatan
    Route::resource('logbooks', \App\Http\Controllers\Mahasiswa\LogbookController::class);

    // Laporan Akhir
    Route::resource('laporan', \App\Http\Controllers\Mahasiswa\LaporanController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    // Nilai Magang
    Route::get('/nilai', function () {
        $application = \App\Models\Application::where('user_id', auth()->id())->first();
        return view('mahasiswa.nilai.index', compact('application'));
    })->name('nilai.index');
});
