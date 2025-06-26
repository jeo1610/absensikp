<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        'nip',
        'idSubstansi',
        'email',
        'namaLengkap',
        'jabatan',
        'bidang',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
    public function substansi()
    {
        return $this->belongsTo(Substansi::class, 'idSubstansi', 'idSubstansi');
    }
    public function melakukan()
    {
        return $this->hasMany(Melakukan::class, 'nip', 'nip');
    }
}
