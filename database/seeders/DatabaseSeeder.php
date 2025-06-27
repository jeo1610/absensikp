<?php

namespace Database\Seeders;

use App\Models\Absen;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Models\Substansi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);

        Substansi::create([
            'namaSubstansi' => 'Dinas Perhubungan',
        ]);

        Substansi::create([
            'namaSubstansi' => 'Dinas Kesehatan',
        ]);

        Substansi::create([
            'namaSubstansi' => 'Dinas Pendidikan',
        ]);

        Pegawai::create([
            'nip' => '123456789012345678',
            'email' => 'email1@example.com',
            'namaLengkap' => 'Budi Santoso',
            'jabatan' => 'Kepala Dinas Perhubungan',
            'password' => Hash::make('password'),
            'idSubstansi' => 1,
        ]);

        Pegawai::create([
            'nip' => '987654321098765432',
            'email' => 'email2@example.com',
            'namaLengkap' => 'Siti Aminah',
            'jabatan' => 'Kepala Dinas Pendidikan',
            'password' => Hash::make('password'),
            'idSubstansi' => 3,
        ]);

        Absen::create([
            'jenisAbsen' => 'masuk',
            'statusQr' => false,
        ]);

        Absen::create([
            'jenisAbsen' => 'keluar',
            'statusQr' => false,
        ]);
    }
}
