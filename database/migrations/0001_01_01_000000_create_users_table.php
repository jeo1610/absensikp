<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('idAdmin');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });
        
        Schema::create('substansi', function (Blueprint $table) {
            $table->id('idSubstansi');
            $table->string('namaSubstansi');
        });

        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->string('email')->unique();
            $table->string('namaLengkap');
            $table->string('jabatan');
            $table->string('bidang');
            $table->string('password');
            $table->unsignedBigInteger('idSubstansi');
            $table->foreign('idSubstansi')->references('idSubstansi')->on('substansi');
            $table->timestamps();
        });

        Schema::create('absen', function (Blueprint $table) {
            $table->id('idAbsen');
            $table->string('jenisAbsen');
            $table->boolean('statusQr')->default(false);
            $table->timestamps();
        });

        Schema::create('melakukan', function (Blueprint $table) {
            $table->id('id');
            $table->string('nip');
            $table->unsignedBigInteger('idAbsen');
            $table->foreign('nip')->references('nip')->on('pegawai');
            $table->foreign('idAbsen')->references('idAbsen')->on('absen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('melakukan');
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('admin');
    }
};
