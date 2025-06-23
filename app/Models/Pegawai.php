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
        'email',
        'namaLengkap',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
    public function melakukan()
    {
        return $this->hasMany(Melakukan::class, 'nip', 'nip');
    }
}
