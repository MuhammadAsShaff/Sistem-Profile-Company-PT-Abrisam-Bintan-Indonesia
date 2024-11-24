<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InventoryExport implements WithMultipleSheets
{
    protected $type; // Inventory Masuk atau Keluar

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function sheets(): array
    {
        // Ambil kategori produk unik dari tabel stock
        $categories = Stock::select('kategoriProduk')->distinct()->pluck('kategoriProduk');

        $sheets = [];
        foreach ($categories as $category) {
            // Tambahkan parameter $type ke constructor
            $sheets[] = new InventoryCategorySheetExport($category, $this->type);
        }

        return $sheets;
    }
}

