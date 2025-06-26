<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Substansi extends Model
{
    protected $table = 'substansi';
    protected $primaryKey = 'idSubstansi';
    public $timestamps = true;
    protected $fillable = [
        'namaSubstansi',
    ];
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'idSubstansi', 'idSubstansi');
    }
}
