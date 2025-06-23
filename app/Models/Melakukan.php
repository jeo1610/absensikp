<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Melakukan extends Model
{
    use HasFactory;
    protected $table = 'melakukan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nip',
        'idAbsensi',
    ];
    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'idAbsensi', 'idAbsensi');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
