<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisiModels extends Model
{
    use HasFactory;
    protected $table = 'divisi';
    protected $fillable = [
        'nama_divisi'
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama_divisi', 'like', '%'.$query.'%');
    }

    public function pegawai(){
    	return $this->hasMany(Pegawai::class);
    }

    public function keluhan(){
    	return $this->hasMany(Keluhan::class);
    }
}
