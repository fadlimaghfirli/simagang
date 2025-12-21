<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vacancy_id',
        'apply_date',
        'status',
        'cv_path',
        'transcript_path',
        'notes',
        'dosen_id',
        'period_id',
        'score_bimbingan',
        'score_laporan',
        'final_score'
    ];

    // Relasi ke Mahasiswa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Lowongan
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    // Relasi ke Dosen
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    // Relasi ke Laporan (dihubungkan via user_id)
    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'user_id', 'user_id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    protected static function booted()
    {
        static::creating(function ($application) {
            $activePeriod = Period::where('is_active', true)->first();
            if ($activePeriod) {
                $application->period_id = $activePeriod->id;
            }
        });

        // GLOBAL SCOPE
        static::addGlobalScope('active_period', function (Builder $builder) {
            $activePeriod = Period::where('is_active', true)->first();
            if ($activePeriod) {
                $builder->where('period_id', $activePeriod->id);
            }
        });
    }
}
