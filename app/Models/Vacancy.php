<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'period_id',
        'position',
        'description',
        'quota',
        'is_active',
    ];

    // 1. Relasi ke Periode
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    // 2. Otomatis isi period_id saat lowongan dibuat
    protected static function booted()
    {
        // 1. Auto-fill period_id (Yang sudah Anda buat sebelumnya)
        static::creating(function ($vacancy) {
            $activePeriod = Period::where('is_active', true)->first();
            if ($activePeriod) {
                $vacancy->period_id = $activePeriod->id;
            }
        });

        // 2. GLOBAL SCOPE: Filter data berdasarkan Periode Aktif
        static::addGlobalScope('active_period', function (Builder $builder) {
            // Cari periode yang sedang aktif
            $activePeriod = Period::where('is_active', true)->first();

            // Jika ada periode aktif, filter query
            if ($activePeriod) {
                $builder->where('period_id', $activePeriod->id);
            } else {
                // (Opsional) Jika tidak ada periode aktif sama sekali, 
                // mungkin kita ingin menyembunyikan semua lowongan, atau menampilkan semua.
                // Di sini kita biarkan saja (tampil semua) atau bisa di-uncomment baris bawah:
                // $builder->whereRaw('1 = 0'); // Jangan tampilkan apa-apa
            }
        });
    }

    // Relasi ke Perusahaan (Kebalikan)
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
