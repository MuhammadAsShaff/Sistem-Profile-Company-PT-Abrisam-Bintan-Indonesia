<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'kegiatan';

    // Tentukan kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'nama',
        'keterangan',
        'gambar', // Menyimpan nama atau path gambar sebagai string
    ];
}
