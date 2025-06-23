<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $primaryKey = 'idAbsensi';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'jenisAbsensi',
        'status_qr',
    ];
    public function melakukan()
    {
        return $this->hasMany(Melakukan::class, 'idAbsensi', 'idAbsensi');
    }
}
