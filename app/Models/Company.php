<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory; // (Opsional, bawaan Laravel 11 biasanya sudah ada atau tidak perlu ditulis jika pakai trait)

    protected $fillable = [
        'name',
        'email',
        'address',
        'website',
        'pic',
    ];

    // Satu perusahaan punya banyak lowongan
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}
