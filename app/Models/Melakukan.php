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
        'idAbsen',
    ];
    public function absen()
    {
        return $this->belongsTo(Absen::class, 'idAbsen', 'idAbsen');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
