<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaProfile extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_profiles';

    protected $fillable = [
        'user_id',
        'nim',
        'angkatan',
        'kelas',
        'no_hp',
        'dosen_wali_id',
    ];

    /**
     * Profil ini milik 1 User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Dosen Wali (User Dosen)
     */
    public function dosenWali()
    {
        return $this->belongsTo(User::class, 'dosen_wali_id');
    }
}
