<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';
    protected $fillable = ['kategoriProduk', 'nomorProduk', 'id_inventoryMasuk', 'id_inventoryKeluar', 'keterangan'];
    protected $primaryKey = 'id_stock';

    protected static function boot()
    {
        parent::boot();

        // Saat stok dipindahkan dari InventoryMasuk ke InventoryKeluar
        static::updating(function ($stock) {
            if ($stock->isDirty('id_inventoryMasuk') && is_null($stock->id_inventoryMasuk)) {
                $inventoryKeluar = \App\Models\InventoryKeluar::where('kategoriProduk', $stock->kategoriProduk)->first();
                if ($inventoryKeluar) {
                    $stock->id_inventoryKeluar = $inventoryKeluar->id_inventoryKeluar;
                }
            }
        });
    }

    // Relasi ke InventoryMasuk
    public function inventoryMasuk()
    {
        return $this->belongsTo(InventoryMasuk::class, 'id_inventoryMasuk', 'id_inventoryMasuk');
    }

    // Relasi ke InventoryKeluar
    public function inventoryKeluar()
    {
        return $this->belongsTo(InventoryKeluar::class, 'id_inventoryKeluar', 'id_inventoryKeluar');
    }
}

