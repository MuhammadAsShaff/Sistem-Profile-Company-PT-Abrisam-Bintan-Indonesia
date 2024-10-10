<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Define the table name (optional if the name follows Laravel's convention)
    protected $table = 'blog';

    // Specify the primary key
    protected $primaryKey = 'id_blog';

    // Fields that are mass assignable
    protected $fillable = [
        'judul_blog',
        'isi_blog',
        'gambar_ilustrasi',
        'gambar_cover',
        'tanggal_penulisan',
    ];

    // Timestamps are enabled by default, so no need to specify
}
