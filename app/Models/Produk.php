<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk'; // Pastikan tabel benar
    protected $primaryKey = 'id_produk'; // Primary key dari tabel
    protected $fillable = [
        'nama_produk', 'harga_produk', 'benefit', 'kecepatan', 'deskripsi', 'diskon', 'gambar_produk', 'id_kategori', 'id_paket'
    ];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relasi ke model Paket
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}
