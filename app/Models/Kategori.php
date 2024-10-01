<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Define the table name (optional if the name follows Laravel's convention)
    protected $table = 'kategori';

    // Specify the primary key
    protected $primaryKey = 'id_kategori';

    // Fields that are mass assignable
    protected $fillable = ['nama_kategori', 'gambar_kategori','deskripsi'];

    // Specify that primary key is not auto-incrementing (since you are using the default)
    public $incrementing = true;

    // Timestamps are enabled by default, no need to specify

    // Relasi ke produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori');
    }
}
