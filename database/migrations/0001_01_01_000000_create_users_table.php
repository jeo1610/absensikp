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

        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->string('email')->unique();
            $table->string('namaLengkap');
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('absensi', function (Blueprint $table) {
            $table->id('idAbsensi');
            $table->string('jenisAbsensi');
            $table->boolean('status_qr')->default(false);
            $table->timestamps();
        });

        Schema::create('melakukan', function (Blueprint $table) {
            $table->id('id');
            $table->string('nip');
            $table->unsignedBigInteger('idAbsensi');
            $table->timestamps();
            $table->foreign('nip')->references('nip')->on('pegawai');
            $table->foreign('idAbsensi')->references('idAbsensi')->on('absensi');
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
