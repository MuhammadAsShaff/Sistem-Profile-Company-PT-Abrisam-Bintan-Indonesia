<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryKeluar extends Model
{
    use HasFactory;

    protected $table = 'inventory_keluar';
    protected $fillable = ['kategoriProduk'];

    // Relasi dengan tabel Stock
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'id_inventoryKeluar', 'id');
    }

    // Atur kapitalisasi kategori produk saat disimpan
    public function setKategoriProdukAttribute($value)
    {
        $this->attributes['kategoriProduk'] = ucwords(strtolower($value));
    }
}
