<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $table = 'reminder';
    protected $fillable = [
        'nama_kegiatan',
        'tempat_acara',
        'tgl_kegiatan',
        'keterangan',
        'waktu_kegiatan',
        'priority',
        'days'
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama_kegiatan', 'like', '%'.$query.'%')
            ->orWhere('tempat_acara', 'like', '%'.$query.'%')
            ->orWhere('keterangan', 'like', '%'.$query.'%')
            ->orWhere('tgl_kegiatan', 'like', '%'.$query.'%');
    }
}
