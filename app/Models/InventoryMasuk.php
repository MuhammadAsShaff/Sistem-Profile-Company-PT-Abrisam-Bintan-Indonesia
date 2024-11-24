<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMasuk extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_inventoryMasuk';
    protected $table = 'inventory_masuk';
    protected $fillable = ['kategoriProduk'];

    // Relasi ke Stock
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'id_inventoryMasuk', 'id_inventoryMasuk');
    }
}
