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

        // Substansi::create([
        //     'namaSubstansi' => 'Dinas Perhubungan',
        // ]);

        // Pegawai::create([
        //     'nip' => '123456789012345678',
        //     'email' => 'pegawai1@example.com',
        //     'namaLengkap' => 'Budi Santoso',
        //     'jabatan' => 'Kepala Dinas',
        //     'bidang' => 'DPM',
        //     'password' => Hash::make('password'),
        // ]);

        // Pegawai::create([
        //     'nip' => '123456789012345679',
        //     'email' => 'pegawai2@example.com',
        //     'namaLengkap' => 'Siti Aminah',
        //     'jabatan' => 'Kepala Dinas',
        //     'bidang' => 'Sekretariat',
        //     'password' => Hash::make('password'),
        // ]);

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
