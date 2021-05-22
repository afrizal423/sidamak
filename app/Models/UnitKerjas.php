<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerjas extends Model
{
    use HasFactory;
    protected $table = 'unit_kerja';
    protected $fillable = [
        'nama_unit'
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama_unit', 'like', '%'.$query.'%');
    }
}
