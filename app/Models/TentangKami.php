<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari default pluralisasi Laravel
    protected $table = 'tentang_kami';

    protected $primaryKey = 'id';
    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'deskripsi_perusahaan',
        'visi',
        'misi',
        'fotoPerusahaan',
        
    ];

}
