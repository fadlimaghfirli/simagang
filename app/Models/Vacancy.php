<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'position',
        'description',
        'quota',
        'is_active',
    ];

    // Relasi ke Perusahaan (Kebalikan)
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
