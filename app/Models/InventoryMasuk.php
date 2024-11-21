<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMasuk extends Model
{
    use HasFactory;

    protected $table = 'inventory_masuk';
    protected $fillable = ['kategoriProduk'];

    protected static function boot()
    {
        parent::boot();

        // Saat membuat InventoryMasuk, otomatis buat entry di InventoryKeluar
        static::created(function ($inventoryMasuk) {
            // Periksa apakah kategori sudah ada di InventoryKeluar
            if (!\App\Models\InventoryKeluar::where('kategoriProduk', $inventoryMasuk->kategoriProduk)->exists()) {
                \App\Models\InventoryKeluar::create(['kategoriProduk' => $inventoryMasuk->kategoriProduk]);
            }
        });
    }

}
