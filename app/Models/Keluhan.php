<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;
    protected $table = 'keluhan';
    protected $fillable = [
        'nama_pelapor',
        'keterangan',
        'tgl_dibuat',
        'tgl_selesai',
        'solusi',
        'status',
        'id_divisi',
        'id_pegawai',
        'is_done_solusi',
        'is_approv'
    ];

    public function divisi(){
    	return $this->belongsTo(DivisiModels::class, 'id_divisi');
    }

    public function pegawai(){
    	return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function pic()
    {
        return $this->belongsToMany(Pegawai::class, 'keluhan_pegawai', 'id_keluhan', 'id_pegawai')
        ->withTimestamps()
        ->as('keluhan_pic');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama_pelapor', 'like', '%'.$query.'%')
            ->orWhere('keterangan', 'like', '%'.$query.'%');
    }
}
