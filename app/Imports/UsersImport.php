<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name'     => $row['nama'],      // Sesuai header di Excel
            'email'    => $row['email'],     // Sesuai header di Excel
            'role'     => $row['role'],      // Sesuai header di Excel (admin/dosen/mahasiswa)
            'password' => Hash::make($row['password']), // Password akan di-hash otomatis
        ]);
    }

    // Agar baris pertama Excel dianggap judul kolom (Header)
    public function rules(): array
    {
        return [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email', // Cek agar email tidak duplikat
            'password' => 'required|min:8',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ];
    }
}
