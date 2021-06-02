<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = [
        'nama_pegawai',
        'no_hp',
        'alamat_pegawai',
        'id_divisi',
        'id_unit',
        'id_jenis_user'
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama_pegawai', 'like', '%'.$query.'%')
            ->orWhere('no_hp', 'like', '%'.$query.'%')->orWhere('alamat_pegawai', 'like', '%'.$query.'%');
    }

    public function divisi(){
    	return $this->belongsTo(DivisiModels::class, 'id_divisi');
    }

    public function unit_kerja(){
    	return $this->belongsTo(UnitKerjas::class, 'id_unit');
    }

    public function jenis_user(){
    	return $this->belongsTo(JenisUsers::class, 'id_jenis_user');
    }
}
