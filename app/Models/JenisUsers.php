<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUsers extends Model
{
    use HasFactory;
    protected $table = 'jenis_user';
    protected $fillable = [
        'nama_jenis'
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama_jenis', 'like', '%'.$query.'%');
    }
}
