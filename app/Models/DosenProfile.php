<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenProfile extends Model
{
    use HasFactory;

    // Tentukan tabel jika nama tabel tidak standar (opsional, tapi aman)
    protected $table = 'dosen_profiles';

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'user_id',
        'nip',
        'nidn',
        'kode_dosen',
        'no_hp',
    ];

    /**
     * Kebalikan relasi: Profil ini milik 1 User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
