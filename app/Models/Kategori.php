<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'kategori';

    // Specify the primary key
    protected $primaryKey = 'id_kategori';

    // Fields that are mass assignable
    protected $fillable = [
        'nama_kategori',
        'gambar_kategori',
        'deskripsi',
        'syarat_ketentuan', // Tambahkan syarat_ketentuan
    ];

    // Specify that primary key is auto-incrementing
    public $incrementing = true;

    // Cast syarat_ketentuan as JSON (array)
    protected $casts = [
        'syarat_ketentuan' => 'array', // Cast sebagai array karena disimpan dalam bentuk JSON
    ];

    // Relasi ke produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori');
    }
}
