<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'absen';
    protected $primaryKey = 'idAbsen';
    protected $fillable = [
        'jenisAbsen',
        'statusQr',
    ];
    public function melakukan()
    {
        return $this->hasMany(Melakukan::class, 'idAbsen', 'idAbsen');
    }
}
