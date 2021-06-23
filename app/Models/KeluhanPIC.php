<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluhanPIC extends Model
{
    use HasFactory;
    protected $table = 'keluhan_pegawai';
    protected $fillable = [
        'id_keluhan',
        'id_pegawai'
    ];
}
