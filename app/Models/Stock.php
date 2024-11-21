<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['namaProduk', 'nomorProduk', 'id_inventoryMasuk', 'id_inventoryKeluar'];

    public static function boot()
    {
        parent::boot();

        // Saat menghapus id_inventoryMasuk, pindahkan ke id_inventoryKeluar
        static::updating(function ($stock) {
            if ($stock->isDirty('id_inventoryMasuk') && $stock->id_inventoryMasuk === null) {
                $stock->id_inventoryKeluar = InventoryKeluar::where('kategoriProduk', $stock->kategoriProduk)->value('id_inventoryKeluar');
            }
        });
    }
}
