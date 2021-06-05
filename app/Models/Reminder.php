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
        'priority'
    ];
}
