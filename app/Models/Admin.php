<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'idAdmin';
    public $timestamps = true;
    protected $fillable = [
        'username',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
}
